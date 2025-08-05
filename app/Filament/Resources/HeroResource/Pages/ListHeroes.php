<?php

namespace App\Filament\Resources\HeroResource\Pages;

use App\Filament\Resources\HeroResource;
use App\Models\Hero;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeroes extends ListRecords
{
    protected static string $resource = HeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    public function mount(): void
    {
        $record = Hero::first() ?? Hero::create([
            'title' => 'Rafting Samir',
            'subtitle' => 'Petualangan seru menyusuri sungai penuh tantangan! Siap basah dan beraksi?',
            'button_text' => 'Lihat Paket Rafting'
        ]);

        $this->redirect(HeroResource::getUrl('edit', ['record' => $record->getKey()]));
    }

}
