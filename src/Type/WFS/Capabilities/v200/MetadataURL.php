<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

/**
 *  WMS 1.3.0 MetadataURL.
 */
class MetadataURL
{
    /**
     * @Type("string")
     * @XmlAttribute(namespace="http://www.w3.org/1999/xlink")
     * @SerializedName("href")
     *
     * @var string
     */
    private $href;

    public function getHref(): string
    {
        return $this->href;
    }

    public function setHref(string $href): self
    {
        $this->href = $href;

        return $this;
    }
}
