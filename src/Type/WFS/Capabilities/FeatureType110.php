<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

class FeatureType110 extends AbstractFeatureType
{
    /**
     * @Type("string")
     * @SerializedName("DefaultSRS")
     *
     * @var string
     */
    protected $defaultSRS;

    /**
     * @Type("array<string>")
     * @XmlList(inline=true, entry="OtherSRS")
     *
     * @var string[]
     */
    protected $otherSRS;

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
     * @return string
     */
    public function getDefaultSRS(): string
    {
        return $this->defaultSRS;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultCRS(): string
    {
        return $this->getDefaultSRS();
    }

    /**
     * Set the value of defaultSRS.
     *
     * @param string $defaultSRS
     *
     * @return self
     */
    public function setDefaultSRS(string $defaultSRS)
    {
        $this->defaultSRS = $defaultSRS;

        return $this;
    }

    /**
     * Get the value of otherSRS.
     *
     * @return string[]
     */
    public function getOtherSRS()
    {
        return $this->otherSRS;
    }

    /**
     * Set the value of otherSRS.
     *
     * @param string[] $otherSRS
     *
     * @return self
     */
    public function setOtherSRS(array $otherSRS)
    {
        $this->otherSRS = $otherSRS;

        return $this;
    }
}
