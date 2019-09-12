<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

/**
 * operationtype for getCapabilities, getMap and getFeatureinfo.
 */
class OperationType
{
    /**
     * @Type("array<string>")
     * @XmlList(inline=true, entry="Format", namespace="http://www.opengis.net/wms")
     *
     * @var string
     */
    private $format;

    /**
     * Get the value of format.
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set the value of format.
     *
     * @param string[] $format
     *
     * @return self
     */
    public function setFormat(array $format)
    {
        $this->format = $format;

        return $this;
    }
}