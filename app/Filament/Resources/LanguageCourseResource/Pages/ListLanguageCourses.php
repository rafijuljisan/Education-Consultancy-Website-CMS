<?php

namespace App\Filament\Resources\LanguageCourseResource\Pages;

use App\Filament\Resources\LanguageCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLanguageCourses extends ListRecords
{
    protected static string $resource = LanguageCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
