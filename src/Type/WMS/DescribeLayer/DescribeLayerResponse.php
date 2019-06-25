<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WMS\DescribeLayer;

use JMS\Serializer\Annotation\Type;

/**
 * Describe layer for WMS version 1.1.1
 */
class DescribeLayerResponse
{
    /**
     * @Type("OgcSerializer\Type\WMS\DescribeLayer\LayerDescription")
     *
     * @var LayerDescription
     */
    private $layerDescription;

    /**
     * Get the value of layerDescription
     */
    public function getLayerDescription() : LayerDescription
    {
        return $this->layerDescription;
    }

    /**
     * Set the value of layerDescription
     *
     * @return  self
     */
    public function setLayerDescription(LayerDescription $layerDescription)
    {
        $this->layerDescription = $layerDescription;

        return $this;
    }
}
