<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Capabilities;

/**
 * WMS 130 adapter.
 */
class WMS130ServiceAdapter implements ServiceCapabilitiesInterface
{
    /**
     * @var Capabilities
     */
    private $capabilities;

    public function __construct(Capabilities $capabilities)
    {
        $this->capabilities = $capabilities;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): string
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getLayerNames(): array
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getLayer(string $name): LayerCapabilitiesInterface
    {
    }
}
