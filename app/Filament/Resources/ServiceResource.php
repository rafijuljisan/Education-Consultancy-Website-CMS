<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
protected static ?string $navigationGroup = 'Site Content';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Service Info')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        \Filament\Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                        \Filament\Forms\Components\FileUpload::make('icon')->image()->directory('services'),
                        \Filament\Forms\Components\Textarea::make('short_description')->rows(3)->columnSpanFull(),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Full Details')
                    ->schema([
                        \Filament\Forms\Components\RichEditor::make('content'),
                        \Filament\Forms\Components\Toggle::make('is_active')->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Service Icon Preview
            Tables\Columns\ImageColumn::make('icon')
                ->label('Icon')
                ->circular(),

            // Service Title & Description
            Tables\Columns\TextColumn::make('title')
                ->label('Service Name')
                ->searchable()
                ->sortable()
                ->description(fn ($record): string => \Illuminate\Support\Str::limit($record->short_description, 50)),

            // Slug for URL reference
            Tables\Columns\TextColumn::make('slug')
                ->badge()
                ->color('gray')
                ->toggleable(isToggledHiddenByDefault: true),

            // Active Status Toggle
            Tables\Columns\ToggleColumn::make('is_active')
                ->label('Active'),

            // Track creation
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            // Filter by Active/Inactive
            Tables\Filters\TernaryFilter::make('is_active')
                ->label('Service Status')
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
