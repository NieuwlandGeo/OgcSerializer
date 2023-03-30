<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use InvalidArgumentException;

/**
 * Holds some common used props for OGC services.
 */
class ServiceCapabilities implements ServiceCapabilitiesInterface
{
    /** @var string|null */
    private $title;

    /** @var LayerCapabilitiesInterface[] */
    private $layers = [];
    /** @var string[] */
    private $versions = [];

    /**
     * @param LayerCapabilitiesInterface[] $layers
     * @param string[]                     $versions
     */
    public function __construct(?string $title, array $layers, array $versions)
    {
        $this->title    = $title;
        $this->versions = $versions;
        $this->setLayers($layers);
    }

    public function getTitle(): ?string
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
}
