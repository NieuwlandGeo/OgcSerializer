<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

/**
 * Holds some common used props for OGC services.
 */
interface ServiceCapabilitiesInterface
{
    public function getTitle(): string;

    public function getLayer(string $name): LayerCapabilitiesInterface;

    /**
     * @return string[]
     */
    public function getLayerNames(): array;
}
