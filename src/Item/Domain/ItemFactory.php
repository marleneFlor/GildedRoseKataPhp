<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\ItemType\AgedBrie;
use GildedRose\ItemType\BackstagePass;
use GildedRose\ItemType\SulfurasItem;
use GildedRose\ItemType\ConjuredItem;
use GildedRose\ItemType\StandardItem;

final class ItemFactory
{
    public static function createUpdater(Item $item): ItemUpdater
    {
        return match (true) {
            $item->name === 'Aged Brie' => new AgedBrie($item),
            $item->name === 'Backstage passes to a TAFKAL80ETC concert' => new BackstagePass($item),
            $item->name === 'Sulfuras, Hand of Ragnaros' => new SulfurasItem($item),
            str_contains($item->name, 'Conjured') => new ConjuredItem($item),
            default => new StandardItem($item),
        };
    }
}
