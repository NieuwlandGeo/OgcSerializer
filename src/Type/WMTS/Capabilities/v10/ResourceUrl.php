<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

class ResourceUrl
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
     * @XmlAttribute
     * @Type("string")
     * @SerializedName("resourceType")
     *
     * @var string|null
     */
    protected $resourceType;

    /**
     * @XmlAttribute
     * @Type("string")
     * @SerializedName("template")
     *
     * @var string|null
     */
    protected $template;

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getResourceType(): string
    {
        return $this->resourceType;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }
}
