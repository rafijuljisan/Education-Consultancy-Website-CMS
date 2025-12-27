<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Group::make()
                    ->schema([
                        \Filament\Forms\Components\Section::make('Program Details')
                            ->schema([
                                // Title & Slug
                                \Filament\Forms\Components\TextInput::make('title')
                                    ->label('Course Name')
                                    ->placeholder('e.g. MSc Project Management')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                                \Filament\Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                // University & Level
                                \Filament\Forms\Components\Select::make('university_id')
                                    ->relationship('university', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        \Filament\Forms\Components\TextInput::make('name')->required(),
                                        \Filament\Forms\Components\TextInput::make('slug')->required(),
                                    ]), // Allows adding a Uni directly from this dropdown

                                \Filament\Forms\Components\Select::make('level')
                                    ->options([
                                        'Foundation' => 'Foundation',
                                        'Undergraduate' => 'Undergraduate',
                                        'Postgraduate' => 'Postgraduate',
                                        'PHD' => 'PhD',
                                    ])
                                    ->required(),

                                // Category (Subject)
                                \Filament\Forms\Components\Select::make('category_id')
                                    ->label('Subject Area')
                                    ->relationship('category', 'name')
                                    ->searchable(),
                            ])->columns(2),

                        \Filament\Forms\Components\Section::make('Description & Requirements')
                            ->schema([
                                \Filament\Forms\Components\RichEditor::make('description')
                                    ->label('Course Overview'),
                                \Filament\Forms\Components\RichEditor::make('entry_requirements')
                                    ->label('Admission Requirements (IELTS/GPA)'),
                            ]),
                    ])->columnSpan(2),

                \Filament\Forms\Components\Group::make()
                    ->schema([
                        \Filament\Forms\Components\Section::make('Key Facts')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('tuition_fee')
                                    ->numeric()
                                    ->prefix('Price'),

                                \Filament\Forms\Components\Select::make('currency')
                                    ->options([
                                        'USD' => 'USD ($)',
                                        'GBP' => 'GBP (£)',
                                        'EUR' => 'EUR (€)',
                                        'AUD' => 'AUD ($)',
                                        'CAD' => 'CAD ($)',
                                    ])
                                    ->default('USD'),

                                \Filament\Forms\Components\TextInput::make('duration')
                                    ->placeholder('e.g. 12 Months'),


                                \Filament\Forms\Components\TextInput::make('intake_months')
                                    ->placeholder('e.g. Jan, Sep'),

                                \Filament\Forms\Components\Toggle::make('is_featured'),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Course Title & University Name
                Tables\Columns\TextColumn::make('title')
                    ->label('Course Name')
                    ->searchable()
                    ->sortable()
                    ->description(fn($record): string => $record->university?->name ?? 'No University'),

                // Academic Level Badge
                Tables\Columns\TextColumn::make('level')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Foundation' => 'gray',
                        'Undergraduate' => 'info',
                        'Postgraduate' => 'success',
                        'PHD' => 'warning',
                        default => 'gray',
                    }),

                // Subject Area (Category)
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Subject Area')
                    ->toggleable()
                    ->searchable(),

                // Combined Tuition Fee & Currency
                Tables\Columns\TextColumn::make('tuition_fee')
                    ->label('Tuition')
                    ->money(fn($record) => $record->currency ?? 'USD')
                    ->sortable(),

                // Intake Months
                Tables\Columns\TextColumn::make('intake_months')
                    ->label('Intakes')
                    ->placeholder('Not specified')
                    ->toggleable(),

                // Duration
                Tables\Columns\TextColumn::make('duration')
                    ->icon('heroicon-m-clock')
                    ->toggleable(),

                // Featured Toggle - Manage visibility directly from the table
                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Featured'),
            ])
            ->filters([
                // Filter by Academic Level
                Tables\Filters\SelectFilter::make('level')
                    ->options([
                        'Foundation' => 'Foundation',
                        'Undergraduate' => 'Undergraduate',
                        'Postgraduate' => 'Postgraduate',
                        'PHD' => 'PhD',
                    ]),

                // Filter by University
                Tables\Filters\SelectFilter::make('university_id')
                    ->relationship('university', 'name')
                    ->searchable()
                    ->preload(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
