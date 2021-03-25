<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractFeatureType;

class FeatureType extends AbstractFeatureType
{
    /**
     * @Type("string")
     * @SerializedName("Name")
     * @XmlElement(namespace="http://www.opengis.net/wfs")
     *
     */
    protected string $name;

    /**
     * @Type("string")
     * @SerializedName("Title")
     * @XmlElement(namespace="http://www.opengis.net/wfs")
     *
     */
    protected string $title;

    /**
     * @Type("string")
     * @SerializedName("DefaultSRS")
     * @XmlElement(namespace="http://www.opengis.net/wfs")
     *
     */
    protected string $defaultSRS;

    /**
     * @Type("array<string>")
     * @XmlList(inline=true, entry="OtherSRS", namespace="http://www.opengis.net/wfs")
     *
     * @var string[]
     */
    protected array $otherSRS;

    public function getName(): string
    {
        return $this->name;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getCrsOptions(): array
    {
        $crs   = $this->getOtherSRS();
        $crs[] = $this->getDefaultSRS();

        return $crs;
    }

    /**
     * Get the value of defaultSRS.
     *
     */
    public function getDefaultSRS(): string
    {
        return $this->defaultSRS;
    }

    public function getDefaultCRS(): string
    {
        return $this->getDefaultSRS();
    }

    /**
     * Set the value of defaultSRS.
     *
     *
     */
    public function setDefaultSRS(string $defaultSRS): self
    {
        $this->defaultSRS = $defaultSRS;

        return $this;
    }

    /**
     * Get the value of otherSRS.
     *
     * @return string[]
     */
    public function getOtherSRS(): array
    {
        return $this->otherSRS;
    }

    /**
     * Set the value of otherSRS.
     *
     * @param string[] $otherSRS
     *
     */
    public function setOtherSRS(array $otherSRS): self
    {
        $this->otherSRS = $otherSRS;

        return $this;
    }
}
