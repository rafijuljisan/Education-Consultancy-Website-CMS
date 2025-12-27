<?php

namespace App\Filament\Resources\WorkPermitResource\Pages;

use App\Filament\Resources\WorkPermitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkPermits extends ListRecords
{
    protected static string $resource = WorkPermitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
