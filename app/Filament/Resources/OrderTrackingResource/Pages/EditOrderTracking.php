<?php

namespace App\Filament\Resources\OrderTrackingResource\Pages;

use App\Filament\Resources\OrderTrackingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderTracking extends EditRecord
{
    protected static string $resource = OrderTrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
