<?php

declare(strict_types=1);

namespace GildedRose\Item\Application\Command;

use GildedRose\Item\Domain\Entity\DomainItem;
use GildedRose\Item\Domain\Repository\ItemRepositoryInterface;
use GildedRose\Item\Domain\ValueObject\Quality;

class CreateItemCommandHandler
{
    public function __construct(
        private ItemRepositoryInterface $repository
    ) {}

    public function __invoke(CreateItemCommand $command): void
    {
        $item = DomainItem::create(
            $command->name,
            $command->sellIn,
            Quality::create($command->quality) 
        );

        $this->repository->create($item);
    }
}