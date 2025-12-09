<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item\Application\Service\SyncItemQuality;

final class GildedRose
{
    private SyncItemQuality $syncItemQuality;

    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
        // Inicializamos el servicio de dominio.
        // Lo hacemos aquí dentro (new) en lugar de inyectarlo para no romper
        // la firma del constructor original de la Kata y que los tests pasen sin cambios.
        $this->syncItemQuality = new SyncItemQuality();
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            // Delegamos la actualización de cada ítem al servicio de aplicación.
            // El servicio se encargará de envolverlo en DomainItem,
            // buscar la estrategia correcta (Updater) y ejecutarla.
            $this->syncItemQuality->sync($item);
        }
    }
}