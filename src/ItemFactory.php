<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item\Domain\Updater\AgedBrie;
use GildedRose\Item\Domain\Updater\BackstagePass;
use GildedRose\Item\Domain\Updater\ConjuredItem;
use GildedRose\Item\Domain\Updater\ItemUpdater;
use GildedRose\Item\Domain\Updater\StandardItem;
use GildedRose\Item\Domain\Updater\Sulfuras;

class ItemFactory
{
    public static function getUpdater(string $itemName): ItemUpdater
    {
        // Detección de Backstage passes (a veces tienen nombres largos como "Backstage passes to...")
        if (str_contains($itemName, 'Backstage passes')) {
            return new BackstagePass();
        }

        // Detección de Conjured
        if (str_contains($itemName, 'Conjured')) {
            return new ConjuredItem();
        }

        return match ($itemName) {
            'Aged Brie' => new AgedBrie(),
            'Sulfuras, Hand of Ragnaros' => new Sulfuras(),
            default => new StandardItem(),
        };
    }
}