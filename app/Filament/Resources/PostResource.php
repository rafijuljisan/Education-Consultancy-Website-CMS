<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Group::make()
                    ->schema([
                        \Filament\Forms\Components\Section::make('Article')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                \Filament\Forms\Components\TextInput::make('slug')->required(),
                                \Filament\Forms\Components\RichEditor::make('content')->required(),
                            ]),
                    ])->columnSpan(2),

                \Filament\Forms\Components\Group::make()
                    ->schema([
                        \Filament\Forms\Components\Section::make('Settings')
                            ->schema([
                                \Filament\Forms\Components\FileUpload::make('thumbnail')
                                    ->image()
                                    ->directory('blog'),
                                \Filament\Forms\Components\DatePicker::make('published_at')
                                    ->default(now()),
                                \Filament\Forms\Components\Toggle::make('is_featured'),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
