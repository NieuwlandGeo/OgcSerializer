<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

/**
 * Data Transfer Object of transformed service capabilities for (javascript) clients.
 */
interface ServiceCapabilitiesInterface
{
    public function getTitle(): ?string;

    public function hasLayer(string $name): bool;

    public function getLayer(string $name): LayerCapabilitiesInterface;

    /**
     * @return string[]
     */
    public function getLayerNames(): array;

    /**
     * @return string[]
     */
    public function getVersions(): array;
}
