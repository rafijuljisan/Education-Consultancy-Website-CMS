<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;
protected static ?string $navigationGroup = 'Inquiries & Applications';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Applicant Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')->readonly(),
                        Forms\Components\TextInput::make('email')->email()->readonly(),
                        Forms\Components\TextInput::make('phone')->readonly(),
                        Forms\Components\TextInput::make('country')->readonly(),
                        Forms\Components\TextInput::make('subject')->readonly(),
                        Forms\Components\TextInput::make('ielts_score')->label('IELTS Score')->readonly(),
                    ])->columns(2),

                Forms\Components\Textarea::make('message')
                    ->columnSpanFull()
                    ->readonly(),

                Forms\Components\Toggle::make('is_read')
                    ->label('Mark as Read')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Date')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('subject'),
                Tables\Columns\TextColumn::make('country'),
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean()
                    ->label('Read Status'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')->label('Read Status'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
