<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GildedRose\Item;
use GildedRose\ItemType\Sulfuras;

final class SulfurasItemTest extends TestCase
{
    public function testSulfurasNeverChanges(): void
    {
        $item = new Item("Sulfuras, Hand of Ragnaros", 0, 80);
        $updater = new Sulfuras($item);

        $updater->updateQuality();

        $this->assertSame(80, $item->quality);
        $this->assertSame(0, $item->sellIn);
    }
}
