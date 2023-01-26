<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic\WMTS;

use InvalidArgumentException;
use Nieuwland\OgcSerializer\Generic\ServiceCapabilities;
use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\TileMatrixSet;

class ServiceWMTSCapabilities extends ServiceCapabilities implements ServiceWMTSCapabilitiesInterface
{
    /** @var TileMatrixSet[]|null */
    private $tileMatrixSets = null;

    public function hasTileMatrixSet(string $identifier): bool
    {
        return null !== $this->tileMatrixSets && isset($this->tileMatrixSets[$identifier]);
    }

    /**
     * @param LayerCapabilitiesInterface[] $layers
     * @param string[]                     $versions
     * @param TileMatrixSet[]|null         $tileMatrixSets
     */
    public function __construct(string $title, array $layers, array $versions, array $tileMatrixSets)
    {
        parent::__construct($title, $layers, $versions);
        $this->setTileMatrixSets($tileMatrixSets);
    }

    public function getTileMatrixSet(string $identifier): TileMatrixSet
    {
        if (false === $this->hasTileMatrixSet($identifier)) {
            throw new InvalidArgumentException('unknown tile matrix set id');
        }

        return $this->tileMatrixSets[$identifier];
    }

    public function setTileMatrixSets(array $tileMatrixSets): void
    {
        $this->tileMatrixSets = [];
        foreach ($tileMatrixSets as $tileMatrixSet) {
            $this->tileMatrixSets[$tileMatrixSet->getIdentifier()] = $tileMatrixSet;
        }
    }
}
