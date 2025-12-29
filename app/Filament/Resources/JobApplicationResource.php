<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobApplicationResource\Pages;
use App\Filament\Resources\JobApplicationResource\RelationManagers;
use App\Models\JobApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static ?string $navigationGroup = 'Inquiries & Applications';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('created_at')->date(),
                \Filament\Tables\Columns\TextColumn::make('career.title')->label('Position'),
                \Filament\Tables\Columns\TextColumn::make('name')->searchable(),
                \Filament\Tables\Columns\TextColumn::make('email'),
                \Filament\Tables\Columns\TextColumn::make('resume_path')
                    ->formatStateUsing(fn() => 'Download Resume')
                    ->url(fn($record) => \Illuminate\Support\Facades\Storage::url($record->resume_path))
                    ->openUrlInNewTab()
                    ->color('primary'),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListJobApplications::route('/'),
            'create' => Pages\CreateJobApplication::route('/create'),
            'edit' => Pages\EditJobApplication::route('/{record}/edit'),
        ];
    }
}
