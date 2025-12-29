<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AffiliateResource\Pages;
use App\Models\Affiliate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AffiliateResource extends Resource
{
    protected static ?string $model = Affiliate::class;
    protected static ?string $navigationGroup = 'Course Management';
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationLabel = 'Affiliate Universities';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('University Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('url')
                            ->label('Website URL')
                            ->url()
                            ->placeholder('https://university.edu'),

                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->directory('affiliates')
                            ->disk('public')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')->height(40),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\ToggleColumn::make('is_active'),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAffiliates::route('/'),
            'create' => Pages\CreateAffiliate::route('/create'),
            'edit' => Pages\EditAffiliate::route('/{record}/edit'),
        ];
    }
}