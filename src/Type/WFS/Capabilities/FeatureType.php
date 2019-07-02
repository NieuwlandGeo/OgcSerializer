<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WFS\Capabilities;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use OgcSerializer\Type\LayerInterface;

class FeatureType implements LayerInterface
{
    /**
     * @Type("string")
     *
     * @var string
     */
    private $name;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $title;

    /**
     * @Type("string")
     * @SerializedName("DefaultCRS")
     *
     * @var string
     */
    private $defaultCRS;

    /**
     * @Type("array")
     * @SerializedName("OtherCRS")
     *
     * @var array
     */
    private $otherCRS;

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

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
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title.
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }
}
