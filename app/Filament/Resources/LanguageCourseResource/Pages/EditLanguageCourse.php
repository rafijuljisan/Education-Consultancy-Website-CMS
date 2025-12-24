<?php

namespace App\Filament\Resources\LanguageCourseResource\Pages;

use App\Filament\Resources\LanguageCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLanguageCourse extends EditRecord
{
    protected static string $resource = LanguageCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
