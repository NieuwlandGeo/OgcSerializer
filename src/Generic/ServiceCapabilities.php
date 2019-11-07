<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

/**
 * Holds some common used props for OGC services.
 */
class ServiceCapabilities implements ServiceCapabilitiesInterface
{
    /**
     * @var string
     */
    private $title;
    /**
     * @var LayerCapabilitiesInterface[]
     */
    private $layers;

    /**
     * @param LayerCapabilitiesInterface[] $layers
     */
    public function __construct(string $title, array $layers)
    {
        $this->title  = $title;
        $this->layers = $layers;
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
}
