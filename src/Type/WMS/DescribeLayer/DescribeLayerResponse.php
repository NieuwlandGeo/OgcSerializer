<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\DescribeLayer;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Describe layer for WMS version 1.1.1.
 *
 * @XmlRoot("WMS_DescribeLayerResponse")
 */
class DescribeLayerResponse
{
    /**
     * @SerializedName("LayerDescription")
     * @Type("Nieuwland\OgcSerializer\Type\WMS\DescribeLayer\LayerDescription")
     *
     * @var LayerDescription
     */
    private $layerDescription;

    /**
     * Get the value of layerDescription.
     */
    public function getLayerDescription(): LayerDescription
    {
        return $this->layerDescription;
    }

    /**
     * Set the value of layerDescription.
     *
     * @return self
     */
    public function setLayerDescription(LayerDescription $layerDescription)
    {
        $this->layerDescription = $layerDescription;

        return $this;
    }
}
