<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutSectionResource\Pages;
use App\Filament\Resources\AboutSectionResource\RelationManagers;
use App\Models\AboutSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutSectionResource extends Resource
{
    protected static ?string $model = AboutSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            \Filament\Forms\Components\Section::make('Section Content')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('title')
                        ->required(),
                    \Filament\Forms\Components\TextInput::make('subtitle'),
                    \Filament\Forms\Components\RichEditor::make('content')
                        ->columnSpanFull(),
                    \Filament\Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('about'),
                ])->columns(2),

            \Filament\Forms\Components\Section::make('Display Settings')
                ->schema([
                    \Filament\Forms\Components\Select::make('layout_type')
                        ->options([
                            'image_left' => 'Image Left / Text Right',
                            'image_right' => 'Text Left / Image Right',
                            'centered_card' => 'Centered Text Card',
                            'stats_row' => 'Statistics Row (Numbers)',
                        ])
                        ->default('image_left')
                        ->required()
                        ->helperText('Choose how this section looks on the website.'),
                    
                    \Filament\Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                    \Filament\Forms\Components\Toggle::make('is_active')
                        ->default(true),
                ])->columns(3),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            \Filament\Tables\Columns\TextColumn::make('title')->sortable(),
            \Filament\Tables\Columns\TextColumn::make('layout_type')
                ->badge()
                ->color('info'),
            \Filament\Tables\Columns\ImageColumn::make('image'),
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
            'index' => Pages\ListAboutSections::route('/'),
            'create' => Pages\CreateAboutSection::route('/create'),
            'edit' => Pages\EditAboutSection::route('/{record}/edit'),
        ];
    }
}
