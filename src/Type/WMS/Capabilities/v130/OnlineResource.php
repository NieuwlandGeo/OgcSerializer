<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

/**
 *  WMS 1.3.0 OnlineResource.
 */
class OnlineResource
{
    /**
     * @Type("string")
     * @XmlAttribute(namespace="http://www.w3.org/1999/xlink")
     * @SerializedName("href")
     *
     * @var string
     */
    private $href;
    /**
     * @Type("string")
     * @XmlAttribute(namespace="http://www.w3.org/1999/xlink")
     * @SerializedName("type")
     *
     * @var string
     */
    private $type;

    public function getHref(): string
    {
        return $this->href;
    }

    public function setHref(string $href): self
    {
        $this->href = $href;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
