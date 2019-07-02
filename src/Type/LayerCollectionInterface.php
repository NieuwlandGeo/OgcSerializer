<?php

declare(strict_types=1);

namespace OgcSerializer\Type;

interface LayerCollectionInterface
{
    /**
     * @return string[]
     */
    public function getLayerNames(): array;

    /**
     * @return LayerInterface
     */
    public function getLayer(string $name): LayerInterface;
}
