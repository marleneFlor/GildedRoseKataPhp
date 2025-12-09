<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\Item\Application\Command\CreateItemCommand;
use GildedRose\Item\Application\Command\CreateItemCommandHandler;
use GildedRose\Item\Application\Command\UpdateItemCommand;
use GildedRose\Item\Application\Command\UpdateItemCommandHandler;
use GildedRose\Item\Infrastructure\Persistence\InMemoryItemRepository;

// 1. Inicialización de la Infraestructura
$repository = new InMemoryItemRepository();

// 2. Inicialización de los Handlers
$createHandler = new CreateItemCommandHandler($repository);
$updateHandler = new UpdateItemCommandHandler($repository);

echo "--- ESTADO INICIAL: CREANDO ITEMS ---\n";

// 3. Creación de Items usando CreateItemCommand::create()
$itemsData = [
    ['Aged Brie', 10, 20],
    ['Backstage passes to a TAFKAL80ETC concert', 12, 20],
    ['Sulfuras, Hand of Ragnaros', 0, 80],
    ['Normal Item', 5, 10], // Creamos este con error a propósito para editarlo luego
];

foreach ($itemsData as $data) {
    // USO DEL FACTORY METHOD ESTÁTICO
    $command = CreateItemCommand::create(
        $data[0], // name
        $data[1], // sellIn
        $data[2]  // quality
    );
    
    $createHandler->__invoke($command);
    
    echo "Creado: {$data[0]} (SellIn: {$data[1]}, Quality: {$data[2]})\n";
}

echo "\n--- PRUEBA: EDICIÓN MANUAL (CORRECCIÓN) ---\n";

// 4. Actualización manual usando UpdateItemCommand::create()
// Corregimos el 'Normal Item' para que tenga calidad 15
$updateCmd = UpdateItemCommand::create(
    'Normal Item', // id (name)
    5,             // sellIn
    15             // quality
);

$updateHandler->__invoke($updateCmd);
echo "Editado manualmente: 'Normal Item' ahora tiene calidad 15.\n";


echo "\n--- SIMULACIÓN: PASAN 2 DÍAS ---\n";

// 5. Simulación del paso del tiempo (Lógica Gilded Rose)
// Recuperamos los items del repositorio para pasárselos a la app legacy
$domainItems = $repository->findAll();
$legacyItems = [];

foreach ($domainItems as $domainItem) {
    // Extraemos el objeto legacy interno para que GildedRose.php pueda iterarlo
    $legacyItems[] = $domainItem->getLegacyItem();
}

$app = new GildedRose($legacyItems);

for ($day = 1; $day <= 2; $day++) {
    echo "\n=== DÍA $day ===\n";
    echo sprintf("%-45s | %-8s | %-8s\n", "Name", "SellIn", "Quality");
    echo str_repeat("-", 65) . "\n";
    
    $app->updateQuality(); // Se ejecuta la lógica de negocio (Updaters)

    foreach ($legacyItems as $item) {
        echo sprintf("%-45s | %-8d | %-8d\n", $item->name, $item->sellIn, $item->quality);
    }
}