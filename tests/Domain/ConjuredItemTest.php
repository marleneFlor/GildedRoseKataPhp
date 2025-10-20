<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GildedRose\Item;
use GildedRose\ItemType\ConjuredItem;

final class ConjuredItemTest extends TestCase
{
    public function testQualityDecreasesTwiceAsFast(): void
    {
        $item = new Item("Conjured Mana Cake", 5, 10);
        $updater = new ConjuredItem($item);

        $updater->updateQuality();

        $this->assertSame(8, $item->quality); // -2
        $this->assertSame(4, $item->sellIn);
    }

    public function testQualityDecreasesFourAfterSellDate(): void
    {
        $item = new Item("Conjured Mana Cake", 0, 10);
        $updater = new ConjuredItem($item);

        $updater->updateQuality();

        $this->assertSame(6, $item->quality); // -4
        $this->assertSame(-1, $item->sellIn);
    }

    public function testQualityNeverNegative(): void
    {
        $item = new Item("Conjured Mana Cake", 5, 1);
        $updater = new ConjuredItem($item);

        $updater->updateQuality();

        $this->assertSame(0, $item->quality);
    }
}
