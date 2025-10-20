<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GildedRose\Item;
use GildedRose\ItemType\BackstagePass;

final class BackstagePassTest extends TestCase
{
    public function testIncreaseQualityWhenMoreThan10Days(): void
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 15, 20);
        $updater = new BackstagePass($item);

        $updater->updateQuality();

        $this->assertSame(21, $item->quality);
        $this->assertSame(14, $item->sellIn);
    }

    public function testIncreaseQualityBy2When10DaysOrLess(): void
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 10, 25);
        $updater = new BackstagePass($item);

        $updater->updateQuality();

        $this->assertSame(27, $item->quality); // +2
    }

    public function testIncreaseQualityBy3When5DaysOrLess(): void
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 5, 25);
        $updater = new BackstagePass($item);

        $updater->updateQuality();

        $this->assertSame(28, $item->quality); // +3
    }

    public function testDropsQualityToZeroAfterConcert(): void
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 0, 30);
        $updater = new BackstagePass($item);

        $updater->updateQuality();

        $this->assertSame(0, $item->quality);
    }

    public function testQualityNeverExceedsFifty(): void
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 5, 49);
        $updater = new BackstagePass($item);

        $updater->updateQuality();

        $this->assertSame(50, $item->quality); // nunca pasa de 50
    }
}
