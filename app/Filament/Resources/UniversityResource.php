<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniversityResource\Pages;
use App\Filament\Resources\UniversityResource\RelationManagers;
use App\Models\University;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UniversityResource extends Resource
{
    protected static ?string $model = University::class;

    protected static ?string $navigationGroup = 'Course Management';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Select::make('country_id')
                    ->relationship('country', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                \Filament\Forms\Components\TextInput::make('slug')->required(),

                \Filament\Forms\Components\FileUpload::make('logo')->image()->directory('universities'),
                \Filament\Forms\Components\TextInput::make('city'),
                \Filament\Forms\Components\TextInput::make('ranking')->numeric()->label('Global Ranking'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Published')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // University Logo Preview
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular(),

                // University Name & City
                Tables\Columns\TextColumn::make('name')
                    ->label('University Name')
                    ->searchable()
                    ->sortable()
                    ->description(fn($record): string => $record->city ?? 'Location not set'),

                // Related Country Name
                Tables\Columns\TextColumn::make('country.name')
                    ->label('Country')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                // Global Ranking with custom icon
                Tables\Columns\TextColumn::make('ranking')
                    ->label('Global Rank')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-m-trophy')
                    ->color('warning'),

                // Track creation
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Status'),
            ])
            ->filters([
                // Filter by Country
                Tables\Filters\SelectFilter::make('country_id')
                    ->relationship('country', 'name')
                    ->searchable()
                    ->preload(),
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
            'index' => Pages\ListUniversities::route('/'),
            'create' => Pages\CreateUniversity::route('/create'),
            'edit' => Pages\EditUniversity::route('/{record}/edit'),
        ];
    }
}
