<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;

class Style
{
    /**
     * @Type("bool")
     * @XmlAttribute
     * @SerializedName("isDefault")
     *
     * @var bool
     */
    protected $isDefault = false;

    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var string
     */
    protected $title;

    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var string
     */
    protected $identifier;

    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var string|null
     */
    protected $abstract;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\LegendUrl")
     * @SerializedName("LegendURL")
     *
     * @var LegendUrl
     */
    protected $legendurl;

    /**
     * Get the value of title.
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Get the value of identifier.
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Get the value of abstract.
     */
    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    /**
     * Get the value of legendurl.
     */
    public function getLegendurl(): ?LegendUrl
    {
        return $this->legendurl;
    }

    /**
     * Get the value of isDefault.
     */
    public function getIsDefault(): bool
    {
        return $this->isDefault;
    }
}
