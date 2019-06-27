<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\Type;

/**
 * WMS Capabilities Capability.
 */
class Capability
{
    /**
     * @Type("OgcSerializer\Type\WMS\Capabilities\Layer")
     *
     * @var Layer
     */
    private $layer;

    /**
     * Get the value of layers.
     *
     * @return Layer
     */
    public function getLayer(): Layer
    {
        return $this->layer;
    }

    /**
     * Set the value of layers.
     *
     * @param Layer $layer
     *
     * @return self
     */
    public function setLayer(Layer $layer): self
    {
        $this->layer = $layer;

        return $this;
    }
}
