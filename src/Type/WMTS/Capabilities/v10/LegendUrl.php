<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

class LegendUrl
{
    /**
     * @XmlAttribute
     * @Type("string")
     * @SerializedName("format")
     *
     * @var string|null
     */
    protected $format;

    /**
     * @XmlAttribute(namespace="http://www.w3.org/1999/xlink")
     * @Type("string")
     * @SerializedName("href")
     *
     * @var string|null
     */
    protected $href;

    /**
     * Get the value of format.
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * Get the value of href.
     */
    public function getHref(): ?string
    {
        return $this->href;
    }
}
