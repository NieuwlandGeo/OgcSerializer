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
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var OperationType
     */
    private $getMap;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\OperationType")
     * @XmlElement(namespace="http://www.opengis.net/wms")
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

    public function getGetMap(): OperationType
    {
        return $this->getMap;
    }

    public function setGetMap(OperationType $getMap): self
    {
        $this->getMap = $getMap;

        return $this;
    }

    public function getGetFeatureInfo(): OperationType
    {
        return $this->getFeatureInfo;
    }

    public function setGetFeatureInfo(OperationType $getFeatureInfo): self
    {
        $this->getFeatureInfo = $getFeatureInfo;

        return $this;
    }

    public function getDescribeLayer(): OperationType
    {
        return $this->describeLayer;
    }

    public function setDescribeLayer(OperationType $describeLayer): self
    {
        $this->describeLayer = $describeLayer;

        return $this;
    }

    public function getGetLegendGraphic(): OperationType
    {
        return $this->getLegendGraphic;
    }

    public function setGetLegendGraphic(OperationType $getLegendGraphic): self
    {
        $this->getLegendGraphic = $getLegendGraphic;

        return $this;
    }
}
