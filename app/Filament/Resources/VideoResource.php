<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;
protected static ?string $navigationGroup = 'Site Content';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('title')
                    ->required(),

                \Filament\Forms\Components\TextInput::make('video_url')
                    ->label('YouTube/Vimeo Link')
                    ->url()
                    ->required()
                    ->helperText('Paste the full URL (e.g., https://www.youtube.com/watch?v=...)'),

                \Filament\Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('videos'),

                \Filament\Forms\Components\Toggle::make('is_featured')
                    ->label('Show on Homepage'),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Video Thumbnail Preview
            Tables\Columns\ImageColumn::make('thumbnail')
                ->label('Preview')
                ->rounded()
                ->size(100),

            // Video Title & Provider Info
            Tables\Columns\TextColumn::make('title')
                ->label('Video Title')
                ->searchable()
                ->sortable()
                ->description(fn ($record): string => \Illuminate\Support\Str::limit($record->video_url, 50)),

            // Homepage Visibility Toggle
            Tables\Columns\ToggleColumn::make('is_featured')
                ->label('Featured'),

            // Track creation date
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            // Filter to show only featured videos
            Tables\Filters\TernaryFilter::make('is_featured')
                ->label('Homepage Featured Only')
                ->boolean(),
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
