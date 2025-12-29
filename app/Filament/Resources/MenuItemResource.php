<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Filament\Resources\MenuItemResource\RelationManagers;
use App\Models\MenuItem;
use App\Models\Country; // Make sure these models exist
use App\Models\Service; // Make sure these models exist
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    protected static ?string $navigationLabel = 'Menu Manager';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Link Generator')
                            ->description('Select content to automatically fill the Label and URL.')
                            ->schema([
                                // 1. Link Type Selector
                                Forms\Components\Select::make('link_source')
                                    ->label('Source')
                                    ->options([
                                        'custom' => 'Custom Link',
                                        'page' => 'Static Page (About, Contact, etc.)',
                                        'country' => 'Destination Country',
                                        'service' => 'Service Page',
                                    ])
                                    ->default('custom')
                                    ->selectablePlaceholder(false)
                                    ->live(), // Important: Updates the form immediately

                                // 2. Selector for Static Pages
                                Forms\Components\Select::make('page_route')
                                    ->label('Select Page')
                                    ->options(function () {
                                        // 1. Define your list of static pages
                                        $pages = [
                                            '/' => 'Home',
                                            '/about' => 'About Us',
                                            '/contact' => 'Contact Us',
                                            '/services' => 'Services Index',
                                            '/destinations' => 'Destinations Index',
                                            '/blog' => 'Blog Index',
                                            '/gallery' => 'Gallery',
                                            '/careers' => 'Careers',
                                            '/work-permit' => 'Work Permit',
                                            '/scholarships' => 'Scholarships',
                                            '/languages' => 'Language Courses',
                                            '/universities' => 'Universities',
                                        ];

                                        // 2. Get all URLs currently saved in the menu
                                        $usedUrls = MenuItem::pluck('url')->toArray();

                                        // 3. Loop through pages and mark the ones that exist
                                        return collect($pages)->mapWithKeys(function ($label, $url) use ($usedUrls) {
                                            $isUsed = in_array($url, $usedUrls);

                                            // Add a visual sign if it's already in the menu
                                            $newLabel = $isUsed ? "{$label} (Already Added ✅)" : "{$label}";

                                            return [$url => $newLabel];
                                        });
                                    })
                                    ->visible(fn(Forms\Get $get) => $get('link_source') === 'page')
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                        if ($state) {
                                            $set('url', $state);
                                            // Optional: Auto-fill the label too if it's empty
                                            // $set('label', ...); 
                                        }
                                    }),

                                // 3. Selector for Countries
                                Forms\Components\Select::make('country_id')
                                    ->label('Select Country')
                                    ->options(Country::where('is_active', true)->pluck('name', 'id'))
                                    ->searchable()
                                    ->visible(fn(Forms\Get $get) => $get('link_source') === 'country')
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                        $country = Country::find($state);
                                        if ($country) {
                                            $set('label', $country->name);
                                            $set('url', '/destinations/' . $country->slug);
                                        }
                                    }),

                                // 4. Selector for Services
                                Forms\Components\Select::make('service_id')
                                    ->label('Select Service')
                                    ->options(Service::where('is_active', true)->pluck('title', 'id'))
                                    ->searchable()
                                    ->visible(fn(Forms\Get $get) => $get('link_source') === 'service')
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                        $service = Service::find($state);
                                        if ($service) {
                                            $set('label', $service->title);
                                            $set('url', '/services/' . $service->slug);
                                        }
                                    }),
                            ])->columns(1),

                        Forms\Components\Section::make('Menu Details')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->required()
                                    ->helperText('The text displayed on the menu.'),

                                Forms\Components\TextInput::make('url')
                                    ->label('URL')
                                    ->required()
                                    ->prefix(fn(Forms\Get $get) => $get('link_source') === 'custom' ? null : url('/'))
                                    ->helperText('Auto-filled by the generator above, but you can edit it.'),

                                Forms\Components\Select::make('parent_id')
                                    ->label('Parent Menu')
                                    ->relationship('parent', 'label', fn($query) => $query->whereNull('parent_id')) // Only show top-level items
                                    ->searchable()
                                    ->preload()
                                    ->placeholder('Top Level (No Parent)'),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0),
                                        Forms\Components\Toggle::make('new_tab')
                                            ->label('Open in new tab')
                                            ->inline(false),
                                    ]),

                                Forms\Components\Toggle::make('is_active')->default(true),
                            ]),
                    ])->columnSpan(2),

                // Helper Sidebar
                Forms\Components\Section::make('Instructions')
                    ->schema([
                        Forms\Components\Placeholder::make('help')
                            ->content('Select a "Source" to automatically find pages. If you want a custom external link, choose "Custom Link" and paste the URL.'),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // LABEL COLUMN (With visual nesting indicator)
                Tables\Columns\TextColumn::make('label')
                    ->label('Menu Item')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->formatStateUsing(function ($state, MenuItem $record) {
                        // If it has a parent, add an arrow to look like a sub-item
                        return $record->parent_id ? '↳ ' . $state : $state;
                    })
                    ->color(fn(MenuItem $record) => $record->parent_id ? 'gray' : 'primary'), // Root items are primary color

                // URL COLUMN
                Tables\Columns\TextColumn::make('url')
                    ->limit(30)
                    ->icon('heroicon-m-link')
                    ->color('gray')
                    ->toggleable(), // Allow hiding this column

                // PARENT COLUMN (Shows badge if it's a sub-menu)
                Tables\Columns\TextColumn::make('parent.label')
                    ->label('Parent Menu')
                    ->badge()
                    ->color('info')
                    ->placeholder('-'),

                // VISIBILITY TOGGLE
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Visible'),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order') // Enables Drag & Drop
            ->filters([
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label('Menu Structure')
                    ->options([
                        'root' => 'Show Top Level Only',
                        'child' => 'Show Sub-menus Only',
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data) {
                        if ($data['value'] === 'root') {
                            return $query->whereNull('parent_id');
                        }
                        if ($data['value'] === 'child') {
                            return $query->whereNotNull('parent_id');
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}