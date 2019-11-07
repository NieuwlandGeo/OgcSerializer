<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

interface ServiceCapabilitiesInterface
{
    public function getTitle(): string;

    public function getLayer(string $name): LayerCapabilitiesInterface;

    /**
     * @return string[]
     */
    public function getLayerNames(): array;
}
