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
            'title' => 'Default Title',
            'subtitle' => 'Default Subtitle',
            'button_text' => 'Default Button'
        ]);

        $this->redirect(HeroResource::getUrl('edit', ['record' => $record->getKey()]));
    }

}
