<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

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

    /**
     * @param LayerCapabilitiesInterface[] $layers
     * @param string[]                     $versions
     */
    public function __construct(string $title, array $layers, array $versions)
    {
        $this->title    = $title;
        $this->versions = $versions;
        $this->setLayers($layers);
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getLayer(string $name): LayerCapabilitiesInterface
    {
        return $this->layers[$name];
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
