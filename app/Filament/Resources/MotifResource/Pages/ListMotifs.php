<?php

namespace App\Filament\Resources\MotifResource\Pages;

use App\Filament\Resources\MotifResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMotifs extends ListRecords
{
    protected static string $resource = MotifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
