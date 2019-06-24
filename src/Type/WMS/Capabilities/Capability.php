<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

class Capability
{
    /**
     * @Type("array<OgcSerializer\Type\WMS\Capabilities\Layer>")
     * @XmlList(inline = true, entry = "Layer")
     *
     * @var Layer[]
     */
    private $layers = [];

    /**
     * Get the value of layers
     *
     * @return  Layer[]
     */
    public function getLayers() : array
    {
        return $this->layers;
    }

    /**
     * Set the value of layers
     *
     * @param  Layer[] $layers
     *
     * @return  self
     */
    public function setLayers(Layer $layers) : self
    {
        $this->layers = $layers;

        return $this;
    }
}
