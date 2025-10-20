<?php

declare(strict_types=1);

namespace GildedRose;

class CreateItemCommandHandler
{
    private function __construct(
        private itemRepositoryInterface $itemRepository
    ) {
    }

    public static function __invoke(
        CreateItemCommand $command
    ): void {
        $item = Item::create(
            $command->name,
            $command->sellIn,
            Quality::create($command->quality)
        );

        $this->itemRepository->create($item);
    }
}
