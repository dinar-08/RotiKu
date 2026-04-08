<?php
namespace App\Filament\Resources\KategoriRotiResource\Pages;

use App\Filament\Resources\KategoriRotiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriRotis extends ListRecords
{
    protected static string $resource = KategoriRotiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
