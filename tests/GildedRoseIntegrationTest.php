<?php

use PHPUnit\Framework\TestCase;
use GildedRose\Item;
use GildedRose\GildedRose;

final class GildedRoseIntegrationTest extends TestCase
{
    public function testUpdateQuality(): void
    {
        $items = [
            new Item("Elixir of the Mongoose", 5, 7),
            new Item("Aged Brie", 2, 0),
            new Item("Sulfuras, Hand of Ragnaros", 0, 80),
            new Item("Backstage passes to a TAFKAL80ETC concert", 15, 20),
        ];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(6, $items[0]->quality);
        $this->assertSame(1, $items[1]->quality);
        $this->assertSame(80, $items[2]->quality);
        $this->assertSame(21, $items[3]->quality);
    }
}
