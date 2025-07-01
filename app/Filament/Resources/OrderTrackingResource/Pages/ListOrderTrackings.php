<?php

namespace App\Filament\Resources\OrderTrackingResource\Pages;

use App\Filament\Resources\OrderTrackingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderTrackings extends ListRecords
{
    protected static string $resource = OrderTrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
