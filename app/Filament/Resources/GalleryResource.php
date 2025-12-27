<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('title')
                    ->placeholder('e.g. Student Convocation 2024'),

                \Filament\Forms\Components\FileUpload::make('image_path')
                    ->label('Photo')
                    ->image()
                    ->directory('gallery')
                    ->required()
                    ->columnSpanFull(),

                \Filament\Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),

                \Filament\Forms\Components\Toggle::make('is_visible')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Large square thumbnail for the gallery image
            Tables\Columns\ImageColumn::make('image_path')
                ->label('Photo')
                ->square()
                ->size(80),

            // Title with placeholder for empty values
            Tables\Columns\TextColumn::make('title')
                ->label('Gallery Title')
                ->searchable()
                ->sortable()
                ->placeholder('Untitled Image'),

            // Sort Order - editable directly from the table
            Tables\Columns\TextInputColumn::make('sort_order')
                ->label('Order')
                ->rules(['numeric'])
                ->sortable(),

            // Visibility Toggle - quickly hide/show images on the frontend
            Tables\Columns\ToggleColumn::make('is_visible')
                ->label('Visible'),

            // Timestamp
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->defaultSort('sort_order', 'asc') // Default to your custom order
        ->filters([
            // Filter to show only hidden or only visible images
            Tables\Filters\TernaryFilter::make('is_visible')
                ->label('Visibility Status')
                ->boolean()
                ->trueLabel('Visible Only')
                ->falseLabel('Hidden Only')
                ->native(false),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])
        ->reorderable('sort_order'); // Allows drag-and-drop reordering
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
