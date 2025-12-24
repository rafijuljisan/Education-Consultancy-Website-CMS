<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LanguageCourseResource\Pages;
use App\Filament\Resources\LanguageCourseResource\RelationManagers;
use App\Models\LanguageCourse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LanguageCourseResource extends Resource
{
    protected static ?string $model = LanguageCourse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            \Filament\Forms\Components\Group::make()
                ->schema([
                    \Filament\Forms\Components\Section::make('Course Info')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                            
                            \Filament\Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                            
                            \Filament\Forms\Components\Textarea::make('short_description')
                                ->rows(3)
                                ->columnSpanFull(),

                            \Filament\Forms\Components\RichEditor::make('content')
                                ->label('Syllabus & Details')
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpan(2),

            \Filament\Forms\Components\Group::make()
                ->schema([
                    \Filament\Forms\Components\Section::make('Settings')
                        ->schema([
                            \Filament\Forms\Components\FileUpload::make('thumbnail')
                                ->image()
                                ->directory('languages')
                                ->required(),
                            
                            \Filament\Forms\Components\TextInput::make('duration')
                                ->placeholder('e.g. 4 Weeks'),
                                
                            \Filament\Forms\Components\TextInput::make('batch_type')
                                ->placeholder('e.g. Mon-Fri'),
                                
                            \Filament\Forms\Components\Select::make('mode')
                                ->options([
                                    'Online' => 'Online',
                                    'Offline' => 'Offline',
                                    'Hybrid' => 'Hybrid (Online + Offline)',
                                ])
                                ->default('Hybrid'),

                            \Filament\Forms\Components\TextInput::make('fee')
                                ->numeric()
                                ->prefix('$'),
                                
                            \Filament\Forms\Components\Toggle::make('is_active')
                                ->default(true),
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
            'index' => Pages\ListLanguageCourses::route('/'),
            'create' => Pages\CreateLanguageCourse::route('/create'),
            'edit' => Pages\EditLanguageCourse::route('/{record}/edit'),
        ];
    }
}
