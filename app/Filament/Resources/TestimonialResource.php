<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Student Info')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('designation')
                            ->placeholder('e.g. Student at University of Toronto'),
                        \Filament\Forms\Components\FileUpload::make('avatar')
                            ->avatar()
                            ->directory('testimonials'),
                        \Filament\Forms\Components\Select::make('rating')
                            ->options([
                                5 => '5 Stars',
                                4 => '4 Stars',
                                3 => '3 Stars',
                            ])
                            ->default(5)
                            ->required(),
                    ])->columns(2),

                \Filament\Forms\Components\Textarea::make('content')
                    ->label('Feedback Message')
                    ->required()
                    ->columnSpanFull(),

                \Filament\Forms\Components\Toggle::make('is_active')->default(true),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Student Avatar - Circular preview
            Tables\Columns\ImageColumn::make('avatar')
                ->label('Photo')
                ->circular(),

            // Student Name & Designation
            Tables\Columns\TextColumn::make('name')
                ->label('Student Name')
                ->searchable()
                ->sortable()
                ->description(fn ($record): string => $record->designation ?? ''),

            // Star Rating - Visual representation
            Tables\Columns\TextColumn::make('rating')
                ->label('Rating')
                ->icon('heroicon-m-star')
                ->color('warning')
                ->sortable(),

            // Status Toggle - Control website visibility
            Tables\Columns\ToggleColumn::make('is_active')
                ->label('Active'),

            // Track submission date
            Tables\Columns\TextColumn::make('created_at')
                ->label('Date Added')
                ->date()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            // Filter by Star Rating
            Tables\Filters\SelectFilter::make('rating')
                ->options([
                    5 => '5 Stars',
                    4 => '4 Stars',
                    3 => '3 Stars',
                ]),

            // Filter for hidden/active reviews
            Tables\Filters\TernaryFilter::make('is_active')
                ->label('Visibility'),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
