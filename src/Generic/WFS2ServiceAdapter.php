<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Capabilities;

/**
 * WFS 2.0.0 adapter.
 */
class WFS2ServiceAdapter implements ServiceCapabilitiesInterface
{
    /**
     * @var Capabilities
     */
    private $capabilities;

    public function __construct(Capabilities $capabilities)
    {
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
