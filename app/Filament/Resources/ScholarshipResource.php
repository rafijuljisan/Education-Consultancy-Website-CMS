<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScholarshipResource\Pages;
use App\Models\Scholarship;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ScholarshipResource extends Resource
{
    protected static ?string $model = Scholarship::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Services';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Scholarship Details')
                    ->tabs([
                        // TAB 1: OVERVIEW
                        Forms\Components\Tabs\Tab::make('Overview')
                            ->schema([
                                Forms\Components\TextInput::make('title')->required()->live(onBlur: true)->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                                
                                Forms\Components\Select::make('country_id')
                                    ->relationship('country', 'name')
                                    ->required(),
                                
                                Forms\Components\Select::make('funding_type')
                                    ->options([
                                        'Fully Funded' => 'Fully Funded',
                                        'Partially Funded' => 'Partially Funded',
                                        'Tuition Free' => 'Tuition Free',
                                    ])->required(),

                                Forms\Components\TextInput::make('degree_level')->placeholder('e.g. Masters, PhD'),
                                Forms\Components\DatePicker::make('deadline'),
                                
                                Forms\Components\FileUpload::make('image')->image()->directory('scholarships')->columnSpanFull(),
                                Forms\Components\RichEditor::make('description')->columnSpanFull(),
                            ])->columns(2),

                        // TAB 2: BENEFITS & REQUIREMENTS
                        Forms\Components\Tabs\Tab::make('Benefits & Criteria')
                            ->schema([
                                Forms\Components\Repeater::make('benefits')
                                    ->label('Scholarship Benefits')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')->required(),
                                        Forms\Components\Textarea::make('description')->rows(2),
                                    ])->columns(2),

                                Forms\Components\Repeater::make('requirements')
                                    ->label('Eligibility Criteria')
                                    ->schema([
                                        Forms\Components\TextInput::make('criteria')->required(),
                                    ]),
                                
                                Forms\Components\Repeater::make('documents')
                                    ->label('Required Documents')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')->required(),
                                        Forms\Components\Textarea::make('note')->rows(1),
                                    ])->grid(2),
                            ]),

                        // TAB 3: PROCESS & TIMELINE
                        Forms\Components\Tabs\Tab::make('Process & Timeline')
                            ->schema([
                                Forms\Components\Repeater::make('timeline')
                                    ->label('Important Dates')
                                    ->schema([
                                        Forms\Components\TextInput::make('event')->label('Event (e.g. Applications Open)'),
                                        Forms\Components\TextInput::make('date')->label('Date (e.g. Sept 1st)'),
                                    ])->columns(2),

                                Forms\Components\Repeater::make('application_process')
                                    ->label('Step-by-Step Guide')
                                    ->schema([
                                        Forms\Components\TextInput::make('step_name')->required(),
                                        Forms\Components\RichEditor::make('description')->toolbarButtons(['bold', 'link']),
                                    ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('country.name')->sortable(),
                Tables\Columns\TextColumn::make('funding_type')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Fully Funded' => 'success',
                        'Partially Funded' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('deadline')->date()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScholarships::route('/'),
            'create' => Pages\CreateScholarship::route('/create'),
            'edit' => Pages\EditScholarship::route('/{record}/edit'),
        ];
    }
}