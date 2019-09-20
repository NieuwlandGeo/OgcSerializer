<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;

/**
 * @XmlNamespace("http://www.opengis.net/wms")
 */
class Request
{
    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\OperationType")
     *
     * @var OperationType
     */
    private $getMap;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\OperationType")
     *
     * @var OperationType
     */
    private $getFeatureInfo;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\OperationType")
     * @XmlElement(namespace="http://www.opengis.net/sld")
     *
     * @var OperationType
     */
    private $describeLayer;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\OperationType")
     * @XmlElement(namespace="http://www.opengis.net/sld")
     *
     * @var OperationType
     */
    private $getLegendGraphic;

    /**
     * Get the value of getMap.
     *
     */
    public function getGetMap(): OperationType
    {
        return $this->getMap;
    }

    /**
     * Set the value of getMap.
     *
     *
     */
    public function setGetMap(OperationType $getMap): self
    {
        $this->getMap = $getMap;

        return $this;
    }

    /**
     * Get the value of getFeatureInfo.
     *
     */
    public function getGetFeatureInfo(): OperationType
    {
        return $this->getFeatureInfo;
    }

    /**
     * Set the value of getFeatureInfo.
     *
     *
     */
    public function setGetFeatureInfo(OperationType $getFeatureInfo): self
    {
        $this->getFeatureInfo = $getFeatureInfo;

        return $this;
    }

    /**
     * Get the value of describeLayer.
     *
     */
    public function getDescribeLayer(): OperationType
    {
        return $this->describeLayer;
    }

    /**
     * Set the value of describeLayer.
     *
     *
     */
    public function setDescribeLayer(OperationType $describeLayer): self
    {
        $this->describeLayer = $describeLayer;

        return $this;
    }

    /**
     * Get the value of getLegendGraphic.
     *
     */
    public function getGetLegendGraphic(): OperationType
    {
        return $this->getLegendGraphic;
    }

    /**
     * Set the value of getLegendGraphic.
     *
     *
     */
    public function setGetLegendGraphic(OperationType $getLegendGraphic): self
    {
        $this->getLegendGraphic = $getLegendGraphic;

        return $this;
    }
}
