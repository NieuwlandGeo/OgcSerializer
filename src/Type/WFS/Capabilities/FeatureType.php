<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

class FeatureType extends AbstractFeatureType
{
    /**
     * @Type("string")
     * @SerializedName("DefaultCRS")
     *
     * @var string
     */
    protected $defaultCRS;

    /**
     * @Type("array<string>")
     * @XmlList(inline=true, entry="OtherCRS")
     *
     * @var string[]
     */
    protected $otherCRS;

    /**
     * Get the value of defaultCRS.
     *
     * @return string
     */
    public function getDefaultCRS()
    {
        return $this->defaultCRS;
    }

    /**
     * Set the value of defaultCRS.
     *
     * @param string $defaultCRS
     *
     * @return self
     */
    public function setDefaultCRS(string $defaultCRS)
    {
        $this->defaultCRS = $defaultCRS;

        return $this;
    }

    /**
     * Get the value of otherCRS.
     *
     * @return array
     */
    public function getOtherCRS()
    {
        return $this->otherCRS;
    }

    /**
     * Set the value of otherCRS.
     *
     * @param array $otherCRS
     *
     * @return self
     */
    public function setOtherCRS(array $otherCRS)
    {
        $this->otherCRS = $otherCRS;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCrsOptions(): array
    {
        $crs   = $this->getOtherCRS();
        $crs[] = $this->getDefaultCRS();

        return $crs;
    }
}
