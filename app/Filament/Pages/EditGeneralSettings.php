<?php

namespace App\Filament\Pages;

use App\Models\GeneralSetting;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;


class EditGeneralSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Site Settings';
    protected static string $view = 'filament.pages.edit-general-settings';
    protected static ?string $title = 'Edit Website Settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = GeneralSetting::first();

        if ($settings) {
            $this->form->fill($settings->toArray());
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Brand Identity
                Section::make('Brand Identity')
                    ->schema([
                        TextInput::make('site_name')
                            ->required(),
                        FileUpload::make('site_logo')
                            ->image()
                            ->directory('brand'),
                        FileUpload::make('site_favicon')
                            ->image()
                            ->directory('brand'),
                    ])->columns(3),

                // 2. Contact Information
                Section::make('Contact Information (Top Bar)')
                    ->schema([
                        TextInput::make('contact_email')
                            ->email()
                            ->label('Support Email'),
                        TextInput::make('contact_phone')
                            ->tel()
                            ->label('Support Phone'),
                        Textarea::make('contact_address')
                            ->rows(2)
                            ->columnSpanFull(),

                        // FIX APPLIED HERE: Removed 'Forms\Components\' prefix
                        Textarea::make('google_map_code')
                            ->label('Google Map Embed Code (<iframe>)')
                            ->helperText('Go to Google Maps -> Share -> Embed a map -> Copy HTML')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2),

                // 3. Social Media Links
                Section::make('Social Media Links')
                    ->description('Leave blank to hide the icon from the header.')
                    ->schema([
                        TextInput::make('facebook_url')
                            ->prefix('facebook.com/')
                            ->label('Facebook URL'),
                        TextInput::make('instagram_url')
                            ->prefix('instagram.com/')
                            ->label('Instagram URL'),
                        TextInput::make('linkedin_url')
                            ->prefix('linkedin.com/in/')
                            ->label('LinkedIn URL'),
                        TextInput::make('twitter_url')
                            ->prefix('x.com/')
                            ->label('X (Twitter) URL'),
                        TextInput::make('youtube_url')
                            ->prefix('youtube.com/')
                            ->label('YouTube URL'),
                    ])->columns(2),

                // 4. Theme Colors
                Section::make('Theme Colors')
                    ->description('These colors update the frontend automatically.')
                    ->schema([
                        ColorPicker::make('primary_color')
                            ->label('Main Color'),
                        ColorPicker::make('secondary_color')
                            ->label('Accent Color'),
                    ])->columns(2),

                // 5. Hero Section
                Section::make('Hero Section')
                    ->schema([
                        TextInput::make('hero_title')
                            ->required(),
                        Textarea::make('hero_description')
                            ->rows(3),
                        FileUpload::make('hero_image')
                            ->image()
                            ->directory('hero'),
                        TextInput::make('hero_button_text'),
                        TextInput::make('hero_button_url'),
                    ])->columns(2),
                Section::make('Analytics & Tracking')
                    ->schema([
                        TextInput::make('google_tag_manager_id')
                            ->label('Google Tag Manager ID')
                            ->placeholder('GTM-XXXXXX')
                            ->helperText('Paste your Container ID here. Leave empty to disable tracking.')
                            ->maxLength(20),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = GeneralSetting::first();

        if (!$settings) {
            $settings = GeneralSetting::create($data);
        } else {
            $settings->update($data);
        }

        Notification::make()
            ->success()
            ->title('Settings Saved')
            ->send();
    }
}