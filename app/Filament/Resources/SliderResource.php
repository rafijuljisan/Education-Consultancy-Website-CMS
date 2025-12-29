<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;
protected static ?string $navigationGroup = 'Site Content';
    // This icon will appear in your sidebar
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Home Sliders';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Slider Details')
                    ->schema([
                        // Image Upload
                        FileUpload::make('image_path')
                            ->label('Slider Image')
                            ->image()
                            ->disk('public') // <--- ADD THIS LINE explicitly
                            ->directory('sliders')
                            ->visibility('public') // <--- ADD THIS LINE ensures file is visible
                            ->required()
                            ->columnSpanFull(),

                        // Text Fields
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('subtitle')
                            ->label('Subtitle (Small Text)')
                            ->maxLength(255),

                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Settings & Button')
                    ->schema([
                        TextInput::make('button_text')
                            ->label('Button Label'),

                        TextInput::make('button_link')
                            ->label('Button URL (e.g., /contact)'),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Active Status')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Image Preview
                ImageColumn::make('image_path')
                    ->label('Image')
                    ->width(100),

                // Title
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                // Active Switch (Clickable in table)
                ToggleColumn::make('is_active')
                    ->label('Active'),

                // Order
                TextColumn::make('sort_order')
                    ->sortable()
                    ->alignCenter(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                //
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}