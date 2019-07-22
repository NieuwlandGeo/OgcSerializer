<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\Type;

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
}
