<?php

declare(strict_types=1);

namespace OgcSerializer\Type;

interface LayerInterface
{
    /**
     * Get name identifying the layer.
     *
     * @return string
     */
    public function getName(): string;
}
