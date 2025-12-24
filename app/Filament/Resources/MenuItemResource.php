<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Filament\Resources\MenuItemResource\RelationManagers;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('label')->required(),
                \Filament\Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->required(),

                // NEW: Parent Select
                \Filament\Forms\Components\Select::make('parent_id')
                    ->label('Parent Menu (Optional)')
                    ->relationship('parent', 'label')
                    ->searchable()
                    ->placeholder('Select a parent if this is a submenu'),

                \Filament\Forms\Components\TextInput::make('sort_order')
                    ->numeric()->default(0),
                \Filament\Forms\Components\Toggle::make('new_tab'),
                \Filament\Forms\Components\Toggle::make('is_active')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('label')->sortable()->searchable(),
                \Filament\Tables\Columns\TextColumn::make('url'),
                \Filament\Tables\Columns\TextColumn::make('sort_order')->sortable(),
                \Filament\Tables\Columns\ToggleColumn::make('is_active'),
            ])
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
