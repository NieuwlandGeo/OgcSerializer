<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Capabilities;

/**
 * WMTS 1.0.
 */
class WMTSServiceAdapter implements ServiceCapabilitiesInterface
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
        return $this->capabilities->getServiceIdentification()->getTitle();
    }

    /**
     * {@inheritdoc}
     */
    public function getLayerNames(): array
    {
        $names = [];
        foreach ($this->capabilities->getContents()->getLayers() as $layer) {
            $names[] = $layer->getIdentifier();
        }

        return $names;
    }

    /**
     * {@inheritdoc}
     */
    public function getLayer(string $name): LayerCapabilitiesInterface
    {
    }
}
