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
            Forms\Components\Section::make('Section Settings')
                ->schema([
                    Forms\Components\Select::make('layout_type')
                        ->options([
                            'image_left' => 'Image Left / Content Right',
                            'image_right' => 'Content Left / Image Right',
                            'history_timeline' => 'History Timeline', // NEW
                            'stats_counter' => 'Numbers/Stats Counter', // NEW
                            'mission_vision' => 'Mission/Vision Cards', // NEW
                            'awards_grid' => 'Awards & Achievements', // NEW
                            'faq_accordion' => 'FAQ Accordion', // NEW
                            'testimonials' => 'Student Testimonials', // NEW
                        ])
                        ->required()
                        ->live() // Makes form reactive
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $state === 'stats_counter' ? $set('bg_color', 'blue') : null),

                    Forms\Components\Select::make('bg_color')
                        ->label('Background Color')
                        ->options([
                            'white' => 'White',
                            'gray' => 'Light Gray',
                            'blue' => 'Blue (Primary)',
                            'dark' => 'Dark/Black',
                        ])
                        ->default('white'),
                        
                    Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                    Forms\Components\Toggle::make('is_active')->default(true),
                ])->columns(4),

            Forms\Components\Section::make('Content')
                ->schema([
                    Forms\Components\TextInput::make('title')->required(),
                    Forms\Components\TextInput::make('subtitle'),
                    
                    // STANDARD CONTENT (Only for Image Left/Right)
                    Forms\Components\RichEditor::make('content')
                        ->visible(fn (Forms\Get $get) => in_array($get('layout_type'), ['image_left', 'image_right', 'mission_vision'])),
                    
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('about')
                        ->visible(fn (Forms\Get $get) => in_array($get('layout_type'), ['image_left', 'image_right'])),

                    // DYNAMIC DATA FIELDS (Based on Layout Type)
                    
                    // 1. HISTORY TIMELINE
                    Forms\Components\Repeater::make('data.timeline')
                        ->label('Timeline Events')
                        ->schema([
                            Forms\Components\TextInput::make('year')->required()->numeric(),
                            Forms\Components\TextInput::make('title')->required(),
                            Forms\Components\Textarea::make('description')->rows(2),
                        ])
                        ->visible(fn (Forms\Get $get) => $get('layout_type') === 'history_timeline')
                        ->columns(3),

                    // 2. STATS COUNTER
                    Forms\Components\Repeater::make('data.stats')
                        ->label('Statistics')
                        ->schema([
                            Forms\Components\TextInput::make('number')->required()->label('Number (e.g. 1500+)'),
                            Forms\Components\TextInput::make('label')->required()->label('Label (e.g. Students)'),
                        ])
                        ->visible(fn (Forms\Get $get) => $get('layout_type') === 'stats_counter')
                        ->columns(2)->grid(4),

                    // 3. MISSION / VISION CARDS
                    Forms\Components\Repeater::make('data.cards')
                        ->label('Cards (Mission, Vision, Goal)')
                        ->schema([
                            Forms\Components\TextInput::make('title')->required(),
                            Forms\Components\Textarea::make('description')->required(),
                            Forms\Components\Select::make('icon')->options(['mission'=>'Target','vision'=>'Eye','goal'=>'Flag'])->default('mission'),
                        ])
                        ->visible(fn (Forms\Get $get) => $get('layout_type') === 'mission_vision')
                        ->columns(3),

                    // 4. AWARDS
                    Forms\Components\Repeater::make('data.awards')
                        ->label('Awards List')
                        ->schema([
                            Forms\Components\TextInput::make('title')->required(),
                            Forms\Components\FileUpload::make('icon')->image()->directory('about/awards'),
                        ])
                        ->visible(fn (Forms\Get $get) => $get('layout_type') === 'awards_grid')
                        ->grid(3),

                    // 5. FAQ
                    Forms\Components\Repeater::make('data.faqs')
                        ->label('Questions & Answers')
                        ->schema([
                            Forms\Components\TextInput::make('question')->required(),
                            Forms\Components\Textarea::make('answer')->required(),
                        ])
                        ->visible(fn (Forms\Get $get) => $get('layout_type') === 'faq_accordion'),
                        
                    // 6. TESTIMONIALS
                    Forms\Components\Repeater::make('data.testimonials')
                        ->label('Student Reviews')
                        ->schema([
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('date')->label('Date (e.g. June 2025)'),
                            Forms\Components\Textarea::make('text')->required(),
                        ])
                        ->visible(fn (Forms\Get $get) => $get('layout_type') === 'testimonials'),

                ]),
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
