<?php

namespace App\Filament\Resources\MotifResource\Pages;

use App\Filament\Resources\MotifResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMotif extends EditRecord
{
    protected static string $resource = MotifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
