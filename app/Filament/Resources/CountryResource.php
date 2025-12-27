<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Country Details')
                    ->tabs([
                        // TAB 1: General Info
                        Forms\Components\Tabs\Tab::make('Overview')
                            ->schema([
                                Forms\Components\TextInput::make('name')->required()->live(onBlur: true)->afterStateUpdated(fn($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                                Forms\Components\FileUpload::make('cover_image')->image()->directory('countries/covers')->columnSpanFull(),
                                Forms\Components\FileUpload::make('flag_image')->image()->directory('countries/flags'),
                                Forms\Components\RichEditor::make('details')->label('Introduction Text')->columnSpanFull(),
                            ]),

                        // TAB 2: Why Study Here?
                        Forms\Components\Tabs\Tab::make('Why Study Here')
                            ->schema([
                                Forms\Components\Repeater::make('why_study')
                                    ->label('Reasons to Study (Bullet Points)')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')->required(),
                                        Forms\Components\Textarea::make('description')->rows(2),
                                    ])->columns(1),
                            ]),

                        // TAB 3: Quick Stats (At a Glance)
                        Forms\Components\Tabs\Tab::make('At a Glance')
                            ->schema([
                                Forms\Components\Repeater::make('quick_stats')
                                    ->label('Quick Facts (e.g. Tuition Fee, Intakes)')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')->required()->label('Label (e.g. Tuition Fee)'),
                                        Forms\Components\TextInput::make('value')->required()->label('Value (e.g. $10,000/year)'),
                                    ])->columns(2)->grid(2),
                            ]),

                        // TAB 4: Living Costs & Requirements (Redesigned)
                        Forms\Components\Tabs\Tab::make('Costs & Visa')
                            ->schema([
                                // 1. LIVING COSTS (Improved Repeater)
                                Forms\Components\Section::make('Cost of Living')
                                    ->schema([
                                        Forms\Components\Repeater::make('living_costs')
                                            ->label('Expense Breakdown')
                                            ->schema([
                                                Forms\Components\TextInput::make('category')
                                                    ->label('Category (e.g. Food, Rent)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                Forms\Components\TextInput::make('cost')
                                                    ->label('Estimated Cost (e.g. £200 - £300)')
                                                    ->required()
                                                    ->columnSpan(1),
                                                Forms\Components\Select::make('icon') // Optional: Add icons for visual appeal
                                                    ->options([
                                                        'home' => 'Housing',
                                                        'food' => 'Food/Groceries',
                                                        'transport' => 'Transport',
                                                        'bill' => 'Utilities/Bills',
                                                        'fun' => 'Entertainment',
                                                    ])
                                                    ->searchable()
                                                    ->columnSpan(2),
                                            ])->columns(4),
                                    ]),

                                // 2. DOCUMENTS (Checklist Style)
                                Forms\Components\Section::make('Documents Required')
                                    ->schema([
                                        Forms\Components\Repeater::make('requirements')
                                            ->label('Document Checklist')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')->required()->label('Document Name'),
                                                Forms\Components\Textarea::make('description')->rows(1)->label('Note (Optional)'),
                                            ])->grid(2), // 2-column input grid
                                    ]),

                                // 3. VISA PROCESS (Timeline Style)
                                Forms\Components\Section::make('Visa Process')
                                    ->schema([
                                        Forms\Components\Repeater::make('visa_steps')
                                            ->label('Application Steps')
                                            ->schema([
                                                Forms\Components\TextInput::make('step_name')->required()->label('Step Title'),
                                                Forms\Components\RichEditor::make('description')->label('Details')->toolbarButtons(['bold', 'link']),
                                            ])->cloneable(),
                                    ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Display the Flag as a small circular thumbnail
            Tables\Columns\ImageColumn::make('flag_image')
                ->label('Flag')
                ->circular()
                ->disk('public'), // Ensure this matches your directory config

            // Main Country Name - Searchable and Sortable
            Tables\Columns\TextColumn::make('name')
                ->label('Country Name')
                ->searchable()
                ->sortable()
                ->weight('bold'),

            // Slug for URL reference
            Tables\Columns\TextColumn::make('slug')
                ->label('Slug')
                ->badge()
                ->color('gray')
                ->searchable(),

            // Quick display of how many "Why Study" points are added
            Tables\Columns\TextColumn::make('why_study')
                ->label('Highlights')
                ->state(fn ($record): int => count($record->why_study ?? []))
                ->suffix(' Points')
                ->color('info'),

            // Timestamps for administrative tracking
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Last Updated')
                ->dateTime()
                ->sortable()
                ->toggleable(),
        ])
        ->filters([
            // You can add custom filters here later if needed
        ])
        ->actions([
            Tables\Actions\ViewAction::make(), // Helpful for reviewing rich content
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])
        ->emptyStateHeading('No Countries Found')
        ->emptyStateDescription('Start by adding a new country to your international education list.');
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
