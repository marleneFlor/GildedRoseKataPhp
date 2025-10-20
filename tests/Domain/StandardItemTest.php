<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GildedRose\Item;
use GildedRose\ItemType\StandardItem;

final class StandardItemTest extends TestCase
{
    public function testQualityDecreasesByOneBeforeSellDate(): void
    {
        $item = new Item("Elixir of the Mongoose", 5, 7);
        $updater = new StandardItem($item);

        $updater->updateQuality();

        $this->assertSame(6, $item->quality);
        $this->assertSame(4, $item->sellIn);
    }

    public function testQualityDecreasesTwiceAfterSellDate(): void
    {
        $item = new Item("Elixir of the Mongoose", 0, 7);
        $updater = new StandardItem($item);

        $updater->updateQuality();

        $this->assertSame(5, $item->quality);
        $this->assertSame(-1, $item->sellIn);
    }

    public function testQualityNeverNegative(): void
    {
        $item = new Item("Elixir of the Mongoose", 5, 0);
        $updater = new StandardItem($item);

        $updater->updateQuality();

        $this->assertSame(0, $item->quality);
    }
}
