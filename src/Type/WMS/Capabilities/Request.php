<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;

/**
 * @XmlNamespace("http://www.opengis.net/wms")
 */
class Request
{
    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\OperationType")
     *
     * @var OperationType
     */
    private $getMap;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\OperationType")
     *
     * @var OperationType
     */
    private $getFeatureInfo;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\OperationType")
     * @XmlElement(namespace="http://www.opengis.net/sld")
     *
     * @var OperationType
     */
    private $describeLayer;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\OperationType")
     * @XmlElement(namespace="http://www.opengis.net/sld")
     *
     * @var OperationType
     */
    private $getLegendGraphic;

    /**
     * Get the value of getMap.
     *
     * @return OperationType
     */
    public function getGetMap()
    {
        return $this->getMap;
    }

    /**
     * Set the value of getMap.
     *
     * @param OperationType $getMap
     *
     * @return self
     */
    public function setGetMap(OperationType $getMap)
    {
        $this->getMap = $getMap;

        return $this;
    }

    /**
     * Get the value of getFeatureInfo.
     *
     * @return OperationType
     */
    public function getGetFeatureInfo()
    {
        return $this->getFeatureInfo;
    }

    /**
     * Set the value of getFeatureInfo.
     *
     * @param OperationType $getFeatureInfo
     *
     * @return self
     */
    public function setGetFeatureInfo(OperationType $getFeatureInfo)
    {
        $this->getFeatureInfo = $getFeatureInfo;

        return $this;
    }

    /**
     * Get the value of describeLayer.
     *
     * @return OperationType
     */
    public function getDescribeLayer()
    {
        return $this->describeLayer;
    }

    /**
     * Set the value of describeLayer.
     *
     * @param OperationType $describeLayer
     *
     * @return self
     */
    public function setDescribeLayer(OperationType $describeLayer)
    {
        $this->describeLayer = $describeLayer;

        return $this;
    }

    /**
     * Get the value of getLegendGraphic.
     *
     * @return OperationType
     */
    public function getGetLegendGraphic()
    {
        return $this->getLegendGraphic;
    }

    /**
     * Set the value of getLegendGraphic.
     *
     * @param OperationType $getLegendGraphic
     *
     * @return self
     */
    public function setGetLegendGraphic(OperationType $getLegendGraphic)
    {
        $this->getLegendGraphic = $getLegendGraphic;

        return $this;
    }
}
