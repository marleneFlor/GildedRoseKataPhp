<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GildedRose\Item;
use GildedRose\ItemType\AgedBrie;

final class AgedBrieTest extends TestCase
{
    public function testQualityIncreasesBeforeSellDate(): void
    {
        $item = new Item("Aged Brie", 5, 10);
        $updater = new AgedBrie($item);

        $updater->updateQuality();

        $this->assertSame(11, $item->quality);
        $this->assertSame(4, $item->sellIn);
    }

    public function testQualityIncreasesTwiceAfterSellDate(): void
    {
        $item = new Item("Aged Brie", 0, 10);
        $updater = new AgedBrie($item);

        $updater->updateQuality();

        $this->assertSame(12, $item->quality);
        $this->assertSame(-1, $item->sellIn);
    }

    public function testQualityDoesNotExceedFifty(): void
    {
        $item = new Item("Aged Brie", 5, 50);
        $updater = new AgedBrie($item);

        $updater->updateQuality();

        $this->assertSame(50, $item->quality);
    }
}
