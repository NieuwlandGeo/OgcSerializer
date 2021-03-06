<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type;

interface LayerCollectionInterface
{
    /**
     * @return string[]
     */
    public function getLayerNames(): array;

    /**
     * @return mixed
     */
    public function getLayer(string $name);
}
