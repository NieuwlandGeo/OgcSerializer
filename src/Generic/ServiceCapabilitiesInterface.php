<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\TileMatrixSet;

/**
 * Data Transfer Object of transformed service capabilities for (javascript) clients.
 */
interface ServiceCapabilitiesInterface
{
    public function getTitle(): string;

    public function hasLayer(string $name): bool;

    public function getLayer(string $name): LayerCapabilitiesInterface;

    /**
     * @return string[]
     */
    public function getLayerNames(): array;

    /**
     * @return string[]
     */
    public function getVersions(): array;

    public function hasTileMatrixSet(string $identifier): bool;

    public function getTileMatrixSet(string $identifier): TileMatrixSet;

    public function setTileMatrixSets(array $tileMatrixSets): void;
}
