<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic\WMTS;

use Nieuwland\OgcSerializer\Generic\ServiceCapabilitiesInterface;
use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\TileMatrixSet;

interface ServiceWMTSCapabilitiesInterface extends ServiceCapabilitiesInterface
{
    public function hasTileMatrixSet(string $identifier): bool;

    public function getTileMatrixSet(string $identifier): TileMatrixSet;

    public function setTileMatrixSets(array $tileMatrixSets): void;
}
