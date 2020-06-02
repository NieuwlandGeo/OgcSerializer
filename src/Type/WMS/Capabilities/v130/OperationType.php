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
     * @var string[]
     */
    private $format = [];

    /**
     * @return string[]
     */
    public function getFormat(): array
    {
        return $this->format;
    }

    /**
     * @param string[] $format
     */
    public function setFormat(array $format): self
    {
        $this->format = $format;

        return $this;
    }
}
