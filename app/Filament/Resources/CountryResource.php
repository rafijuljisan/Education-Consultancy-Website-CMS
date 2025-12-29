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
    protected static ?string $navigationGroup = 'Site Content';
    protected static ?string $navigationIcon = 'heroicon-o-flag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Country Details')
                    ->tabs([
                        // TAB 1: General Info
                        Forms\Components\Tabs\Tab::make('Overview')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Basic Information')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state)))
                                            ->columnSpan(1),
                                        
                                        Forms\Components\TextInput::make('slug')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->columnSpan(1),
                                        
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Published')
                                            ->helperText('Only active countries appear on the website')
                                            ->default(true)
                                            ->columnSpan(2),
                                        
                                        Forms\Components\Textarea::make('short_description')
                                            ->label('Short Description (SEO & Cards)')
                                            ->helperText('Displayed in hero section and country listing cards. Max 255 characters.')
                                            ->maxLength(255)
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ])->columns(2),

                                Forms\Components\Section::make('Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('flag_image')
                                            ->image()
                                            ->directory('countries/flags')
                                            ->imageEditor()
                                            ->columnSpan(1),
                                        
                                        Forms\Components\FileUpload::make('cover_image')
                                            ->image()
                                            ->directory('countries/covers')
                                            ->imageEditor()
                                            ->columnSpan(1),
                                    ])->columns(2),

                                Forms\Components\Section::make('Introduction')
                                    ->schema([
                                        Forms\Components\RichEditor::make('details')
                                            ->label('Detailed Overview')
                                            ->helperText('Main introduction text about studying in this country')
                                            ->toolbarButtons([
                                                'bold', 'italic', 'underline', 'link',
                                                'bulletList', 'orderedList', 'h2', 'h3'
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // TAB 2: Why Study Here?
                        Forms\Components\Tabs\Tab::make('Why Study Here')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Forms\Components\Repeater::make('why_study')
                                    ->label('Key Benefits & Highlights')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->placeholder('e.g. World-Recognized Degrees')
                                            ->columnSpan(2),
                                        Forms\Components\Textarea::make('description')
                                            ->required()
                                            ->rows(3)
                                            ->placeholder('Explain this benefit in detail...')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2)
                                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                    ->collapsible()
                                    ->cloneable()
                                    ->reorderable()
                                    ->defaultItems(0),
                            ]),

                        // TAB 3: Quick Stats
                        Forms\Components\Tabs\Tab::make('At a Glance')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Forms\Components\Repeater::make('quick_stats')
                                    ->label('Key Facts & Statistics')
                                    ->helperText('Displayed in hero section and comparison tables')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->required()
                                            ->placeholder('e.g. Tuition Fee, Main Intake')
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('value')
                                            ->required()
                                            ->placeholder('e.g. USD 3,000 - 6,000')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2)
                                    ->grid(2)
                                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                                    ->collapsible()
                                    ->reorderable()
                                    ->defaultItems(0),
                            ]),

                        // TAB 4: Costs & Requirements
                        Forms\Components\Tabs\Tab::make('Costs & Requirements')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Forms\Components\Section::make('Cost of Living')
                                    ->schema([
                                        Forms\Components\Repeater::make('living_costs')
                                            ->label('Monthly Expense Breakdown')
                                            ->schema([
                                                Forms\Components\TextInput::make('category')
                                                    ->label('Category')
                                                    ->required()
                                                    ->placeholder('e.g. Accommodation, Food')
                                                    ->columnSpan(1),
                                                
                                                Forms\Components\TextInput::make('cost')
                                                    ->label('Estimated Cost')
                                                    ->required()
                                                    ->placeholder('e.g. USD 800 - 1,500')
                                                    ->columnSpan(1),
                                                
                                                Forms\Components\Select::make('icon')
                                                    ->label('Icon')
                                                    ->options([
                                                        'home' => '🏠 Housing',
                                                        'food' => '🍔 Food/Groceries',
                                                        'transport' => '🚌 Transport',
                                                        'bill' => '💡 Utilities/Bills',
                                                        'health' => '💊 Healthcare',
                                                        'fun' => '💰 Entertainment',
                                                    ])
                                                    ->searchable()
                                                    ->columnSpan(1),
                                                
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Additional Details (Optional)')
                                                    ->rows(1)
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(4)
                                            ->itemLabel(fn (array $state): ?string => $state['category'] ?? null)
                                            ->collapsible()
                                            ->reorderable()
                                            ->defaultItems(0),
                                    ]),

                                Forms\Components\Section::make('Documents Required')
                                    ->schema([
                                        Forms\Components\Repeater::make('requirements')
                                            ->label('Application Document Checklist')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->required()
                                                    ->label('Document Name')
                                                    ->placeholder('e.g. Passport, Academic Transcripts')
                                                    ->columnSpan(1),
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Notes/Requirements (Optional)')
                                                    ->rows(1)
                                                    ->placeholder('e.g. Must have 18 months validity')
                                                    ->columnSpan(1),
                                            ])
                                            ->columns(2)
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                            ->collapsible()
                                            ->reorderable()
                                            ->defaultItems(0),
                                    ]),
                            ]),

                        // TAB 5: Visa & Immigration
                        Forms\Components\Tabs\Tab::make('Visa & Immigration')
                            ->icon('heroicon-o-identification')
                            ->schema([
                                Forms\Components\Section::make('General Visa Information')
                                    ->schema([
                                        Forms\Components\RichEditor::make('visa_info')
                                            ->label('Visa Overview')
                                            ->helperText('General visa requirements, types, and application routes')
                                            ->toolbarButtons([
                                                'bold', 'italic', 'link', 'bulletList', 'orderedList'
                                            ])
                                            ->columnSpanFull(),
                                    ]),

                                Forms\Components\Section::make('Step-by-Step Visa Process')
                                    ->schema([
                                        Forms\Components\Repeater::make('visa_steps')
                                            ->label('Application Timeline')
                                            ->schema([
                                                Forms\Components\TextInput::make('step_name')
                                                    ->required()
                                                    ->label('Step Title')
                                                    ->placeholder('e.g. University Application, Visa Interview')
                                                    ->columnSpanFull(),
                                                Forms\Components\RichEditor::make('description')
                                                    ->label('Details & Instructions')
                                                    ->required()
                                                    ->toolbarButtons(['bold', 'italic', 'link'])
                                                    ->columnSpanFull(),
                                            ])
                                            ->itemLabel(fn (array $state): ?string => $state['step_name'] ?? null)
                                            ->collapsible()
                                            ->cloneable()
                                            ->reorderable()
                                            ->defaultItems(0),
                                    ]),

                                Forms\Components\Section::make('Work Permit & Employment')
                                    ->schema([
                                        Forms\Components\RichEditor::make('work_permit_info')
                                            ->label('Work While Studying')
                                            ->helperText('Information about part-time work rights, restrictions, and opportunities')
                                            ->toolbarButtons([
                                                'bold', 'italic', 'link', 'bulletList', 'orderedList', 'h3'
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('flag_image')
                    ->label('Flag')
                    ->circular()
                    ->disk('public'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Country Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record): string => $record->short_description ?? 'No description'),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('universities_count')
                    ->label('Universities')
                    ->counts('universities')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                Tables\Columns\TextColumn::make('why_study')
                    ->label('Highlights')
                    ->state(fn($record): int => count($record->why_study ?? []))
                    ->suffix(' Points')
                    ->badge()
                    ->color('warning')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All Countries')
                    ->trueLabel('Published')
                    ->falseLabel('Draft')
                    ->default(true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No Countries Found')
            ->emptyStateDescription('Start by adding a new country to your international education list.')
            ->emptyStateIcon('heroicon-o-flag');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UniversitiesRelationManager::class,
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