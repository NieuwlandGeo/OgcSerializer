<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 *  WMS 1.3.0 MetadataURL.
 */
class MetadataURL
{
    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var string
     */
    private $format;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\OnlineResource")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var OnlineResource
     */
    private $onlineResource;

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getOnlineResource(): OnlineResource
    {
        return $this->onlineResource;
    }

    public function setOnlineResource(OnlineResource $onlineResource): self
    {
        $this->onlineResource = $onlineResource;

        return $this;
    }
}
