<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkPermitResource\Pages;
use App\Models\WorkPermit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class WorkPermitResource extends Resource
{
    protected static ?string $model = WorkPermit::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Inquiries & Applications';
    protected static ?string $navigationLabel = 'Work Permits';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // TAB 1: General Info
                Forms\Components\Tabs::make('Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Overview')
                            ->schema([
                                Forms\Components\TextInput::make('country')->required(),
                                Forms\Components\TextInput::make('title')->required()->live(onBlur: true)->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                                Forms\Components\FileUpload::make('image')->image()->directory('work-permits')->columnSpanFull(),

                                Forms\Components\Grid::make(3)->schema([
                                    Forms\Components\TextInput::make('salary_range'),
                                    Forms\Components\TextInput::make('processing_time'),
                                    Forms\Components\TextInput::make('visa_type'),
                                ]),

                                Forms\Components\RichEditor::make('description')->label('Main Description (Intro, Types, Sectors)'),
                                Forms\Components\RichEditor::make('requirements')->label('Requirements & Documents'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Process & FAQs')
                            ->schema([
                                // HOW TO APPLY (Repeater)
                                Forms\Components\Repeater::make('process_steps')
                                    ->label('How to Apply (Steps)')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')->required(),
                                        Forms\Components\Textarea::make('description')->rows(2),
                                    ])
                                    ->columns(2),

                                // FAQS (Repeater)
                                Forms\Components\Repeater::make('faqs')
                                    ->label('Frequently Asked Questions')
                                    ->schema([
                                        Forms\Components\TextInput::make('question')->required(),
                                        Forms\Components\Textarea::make('answer')->rows(3),
                                    ]),
                            ]),
                        Forms\Components\Tabs\Tab::make('Work Details')
                            ->schema([
                                // 1. PERMIT TYPES (Repeater)
                                Forms\Components\Repeater::make('permit_types')
                                    ->label('Types of Work Permits')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->placeholder('e.g. Standard Work Permit'),
                                        Forms\Components\Textarea::make('description')
                                            ->rows(3)
                                            ->placeholder('Description of this permit type...'),
                                    ])
                                    ->columns(1)
                                    ->grid(2), // Displays as a grid in admin

                                // 2. SECTORS (Repeater)
                                Forms\Components\Repeater::make('sectors')
                                    ->label('In-Demand Sectors')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->placeholder('e.g. IT and Software'),
                                    ])
                                    ->grid(3), // 3-column grid for compactness
                            ]),
                        Forms\Components\Tabs\Tab::make('Gallery')
                            ->schema([
                                Forms\Components\FileUpload::make('gallery')
                                    ->label('Experience the Beauty (Images)')
                                    ->multiple()
                                    ->directory('work-permits/gallery')
                                    ->panelLayout('grid'),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('country')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('salary_range'),
                Tables\Columns\ToggleColumn::make('is_active'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListWorkPermits::route('/'),
            'create' => Pages\CreateWorkPermit::route('/create'),
            'edit' => Pages\EditWorkPermit::route('/{record}/edit'),
        ];
    }
}