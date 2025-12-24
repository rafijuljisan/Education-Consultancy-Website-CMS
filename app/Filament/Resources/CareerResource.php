<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Filament\Resources\CareerResource\RelationManagers;
use App\Models\Career;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            \Filament\Forms\Components\Group::make()
                ->schema([
                    \Filament\Forms\Components\Section::make('Job Details')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                            
                            \Filament\Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                            
                            \Filament\Forms\Components\Grid::make(2)
                                ->schema([
                                    \Filament\Forms\Components\TextInput::make('location')
                                        ->placeholder('e.g. London / Remote'),
                                    \Filament\Forms\Components\Select::make('type')
                                        ->options([
                                            'Full Time' => 'Full Time',
                                            'Part Time' => 'Part Time',
                                            'Contract' => 'Contract',
                                            'Internship' => 'Internship',
                                        ]),
                                ]),

                            \Filament\Forms\Components\RichEditor::make('description')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(2),

            \Filament\Forms\Components\Group::make()
                ->schema([
                    \Filament\Forms\Components\Section::make('Status')
                        ->schema([
                            \Filament\Forms\Components\Toggle::make('is_active')
                                ->label('Published on Website')
                                ->default(true),
                                
                            \Filament\Forms\Components\Toggle::make('is_filled')
                                ->label('Mark as Hired / Filled')
                                ->default(false),
                                
                            \Filament\Forms\Components\TextInput::make('salary_range')
                                ->numeric()
                                ->prefix('$'),
                        ]),
                ])->columnSpan(1),
        ])->columns(3);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            \Filament\Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            \Filament\Tables\Columns\TextColumn::make('location'),
            \Filament\Tables\Columns\TextColumn::make('type')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Full Time' => 'success',
                    'Part Time' => 'warning',
                    'Internship' => 'info',
                    default => 'gray',
                }),
            \Filament\Tables\Columns\IconColumn::make('is_filled')
                ->label('Hired?')
                ->boolean(),
            \Filament\Tables\Columns\TextColumn::make('created_at')->date(),
        ])
        ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}
