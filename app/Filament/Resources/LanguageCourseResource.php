<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LanguageCourseResource\Pages;
use App\Filament\Resources\LanguageCourseResource\RelationManagers;
use App\Models\LanguageCourse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LanguageCourseResource extends Resource
{
    protected static ?string $model = LanguageCourse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Course Details')
                    ->tabs([
                        // TAB 1: BASIC INFO (Existing)
                        Forms\Components\Tabs\Tab::make('Overview')
                            ->schema([
                                Forms\Components\TextInput::make('title')->required()->live(onBlur: true)->afterStateUpdated(fn($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                                Forms\Components\FileUpload::make('thumbnail')->image()->directory('languages')->columnSpanFull(),
                                Forms\Components\Textarea::make('short_description')->rows(2)->columnSpanFull(),

                                Forms\Components\Grid::make(3)->schema([
                                    Forms\Components\TextInput::make('duration')->placeholder('e.g. 4 Weeks'),
                                    Forms\Components\TextInput::make('batch_type')->placeholder('e.g. Mon-Fri'),
                                    Forms\Components\TextInput::make('fee')->numeric()->prefix('$'),
                                ]),
                                Forms\Components\Grid::make(2)->schema([
                                    Forms\Components\DatePicker::make('start_date')
                                        ->label('Next Batch Start Date')
                                        ->native(false) // Use a nice JS picker
                                        ->displayFormat('d M Y'),

                                    Forms\Components\Toggle::make('certificate_available')
                                        ->label('Certificate Provided?')
                                        ->default(true)
                                        ->inline(false),
                                ]),
                                Forms\Components\Select::make('mode')->options(['Online' => 'Online', 'Offline' => 'Offline', 'Hybrid' => 'Hybrid'])->default('Hybrid'),
                                Forms\Components\Toggle::make('is_active')->default(true),
                            ]),

                        // TAB 2: WHY LEARN & FEATURES
                        Forms\Components\Tabs\Tab::make('Benefits & Features')
                            ->schema([
                                Forms\Components\Repeater::make('benefits')
                                    ->label('Why Learn? (Benefits)')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')->required(),
                                        Forms\Components\Textarea::make('description')->rows(2),
                                    ])->columns(2),

                                Forms\Components\Repeater::make('features')
                                    ->label('Our Commitment (Features)')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')->required(),
                                        Forms\Components\Textarea::make('description')->rows(2),
                                    ])->columns(2),
                            ]),

                        // TAB 3: COURSE VARIANTS (Crash vs Comprehensive)
                        Forms\Components\Tabs\Tab::make('Course Options')
                            ->schema([
                                Forms\Components\Repeater::make('variants')
                                    ->label('Course Types (e.g. Crash Course)')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')->label('Course Name')->required(),
                                        Forms\Components\TextInput::make('duration')->label('Duration (e.g. 4 Weeks)'),
                                        Forms\Components\RichEditor::make('details')->label('What you will learn')->toolbarButtons(['bulletList', 'bold']),
                                    ])->columns(1)->grid(2),
                            ]),

                        // TAB 4: REVIEWS & FAQ
                        Forms\Components\Tabs\Tab::make('Reviews & FAQs')
                            ->schema([
                                Forms\Components\Repeater::make('course_testimonials')
                                    ->label('Student Success Stories')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')->required(),
                                        Forms\Components\TextInput::make('designation')->label('Role/Location'),
                                        Forms\Components\Textarea::make('quote')->rows(2),
                                    ])->columns(2),

                                Forms\Components\Repeater::make('faqs')
                                    ->label('FAQs')
                                    ->schema([
                                        Forms\Components\TextInput::make('question')->required(),
                                        Forms\Components\Textarea::make('answer')->rows(2),
                                    ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Small preview of the language/course thumbnail
            Tables\Columns\ImageColumn::make('thumbnail')
                ->circular(),

            // Course Name with short description as secondary text
            Tables\Columns\TextColumn::make('title')
                ->label('Course Name')
                ->searchable()
                ->sortable()
                ->description(fn ($record): string => \Illuminate\Support\Str::limit($record->short_description, 40)),

            // Fee with dynamic currency symbol from your form prefix
            Tables\Columns\TextColumn::make('fee')
                ->money('USD') // Defaults to USD as per your prefix
                ->sortable(),

            // Learning Mode Badge
            Tables\Columns\TextColumn::make('mode')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Online' => 'success',
                    'Offline' => 'warning',
                    'Hybrid' => 'info',
                }),

            // Start Date for the next batch
            Tables\Columns\TextColumn::make('start_date')
                ->label('Next Batch')
                ->date('d M Y')
                ->sortable(),

            // Status Toggles
            Tables\Columns\ToggleColumn::make('certificate_available')
                ->label('Cert.'),
                
            Tables\Columns\ToggleColumn::make('is_active')
                ->label('Status'),
        ])
        ->filters([
            // Filter by Online/Offline mode
            Tables\Filters\SelectFilter::make('mode')
                ->options([
                    'Online' => 'Online',
                    'Offline' => 'Offline',
                    'Hybrid' => 'Hybrid',
                ]),
                
            // Filter for only active courses
            Tables\Filters\TernaryFilter::make('is_active')
                ->label('Active Courses Only')
                ->boolean(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListLanguageCourses::route('/'),
            'create' => Pages\CreateLanguageCourse::route('/create'),
            'edit' => Pages\EditLanguageCourse::route('/{record}/edit'),
        ];
    }
}
