<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use InvalidArgumentException;
use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\TileMatrixSet;

/**
 * Holds some common used props for OGC services.
 */
class ServiceCapabilities implements ServiceCapabilitiesInterface
{
    /** @var string */
    private $title;

    /** @var LayerCapabilitiesInterface[] */
    private $layers = [];
    /** @var string[] */
    private $versions = [];
    /** @var TileMatrixSet[]|null */
    private $tileMatrixSets = null;

    /**
     * @param LayerCapabilitiesInterface[] $layers
     * @param string[]                     $versions
     * @param TileMatrixSet[]|null         $tileMatrixSets
     */
    public function __construct(string $title, array $layers, array $versions, array $tileMatrixSets = null)
    {
        $this->title    = $title;
        $this->versions = $versions;
        $this->setLayers($layers);
        if (null === $tileMatrixSets) {
            return;
        }
        $this->setTileMatrixSets($tileMatrixSets);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLayer(string $name): LayerCapabilitiesInterface
    {
        if (false === $this->hasLayer($name)) {
            throw new InvalidArgumentException('unknown layer name');
        }

        return $this->layers[$name];
    }

    public function hasLayer(string $name): bool
    {
        return isset($this->layers[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function getLayerNames(): array
    {
        $names = [];
        foreach ($this->layers as $layer) {
            $names[] = $layer->getName();
        }

        return $names;
    }

    /**
     * @param LayerCapabilitiesInterface[] $layers
     */
    private function setLayers(array $layers): void
    {
        foreach ($layers as $layer) {
            $this->layers[$layer->getName()] = $layer;
        }
    }

    /**
     * @return string[]
     */
    public function getVersions(): array
    {
        return $this->versions;
    }

    public function hasTileMatrixSet(string $identifier): bool
    {
        return null !== $this->tileMatrixSets && isset($this->tileMatrixSets[$identifier]);
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
