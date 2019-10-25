<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

/**
 *  WMS 1.3.0 LegendURL.
 */
class LegendURL
{
    /**
     * @Type("int")
     * @SerializedName("width")
     * @XmlAttribute
     *
     * @var int
     */
    private $width;
    /**
     * @Type("int")
     * @SerializedName("height")
     * @XmlAttribute
     *
     * @var int
     */
    private $height;
    /**
     * @Type("string")
     *
     * @var string
     */
    private $format;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\OnlineResource")
     *
     * @var OnlineResource
     */
    private $onlineResource;

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

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
