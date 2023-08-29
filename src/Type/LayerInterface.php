<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type;

interface LayerInterface
{
    /**
     * Get name identifying the layer.
     */
    public function getName(): ?string;

    /**
     * Get available CRS.
     *
     * @return string[]
     */
    public function getCrsOptions(): array;

    public function getMetadataURL(): ?string;
}
