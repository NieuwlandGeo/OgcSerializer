<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Base on WMS 1.3.0 EX_GeographicBoundingBox.
 */
class ExGeographicBoundingBox
{
    /**
     * @Type("float")
     * @SerializedName("westBoundLongitude")
     *
     * @var float
     */
    private $westBoundLongitude;

    /**
     * @Type("float")
     * @SerializedName("eastBoundLongitude")
     *
     * @var float
     */
    private $eastBoundLongitude;

    /**
     * @Type("float")
     * @SerializedName("southBoundLatitude")
     *
     * @var float
     */
    private $southBoundLatitude;

    /**
     * @Type("float")
     * @SerializedName("northBoundLatitude")
     *
     * @var float
     */
    private $northBoundLatitude;

    /**
     * Get the value of westBoundLongitude.
     *
     */
    public function getWestBoundLongitude(): float
    {
        return $this->westBoundLongitude;
    }

    /**
     * Set the value of westBoundLongitude.
     *
     *
     */
    public function setWestBoundLongitude(float $westBoundLongitude): self
    {
        $this->westBoundLongitude = $westBoundLongitude;

        return $this;
    }

    /**
     * Get the value of eastBoundLongitude.
     *
     */
    public function getEastBoundLongitude(): float
    {
        return $this->eastBoundLongitude;
    }

    /**
     * Set the value of eastBoundLongitude.
     *
     *
     */
    public function setEastBoundLongitude(float $eastBoundLongitude): self
    {
        $this->eastBoundLongitude = $eastBoundLongitude;

        return $this;
    }

    /**
     * Get the value of southBoundLatitude.
     *
     */
    public function getSouthBoundLatitude(): float
    {
        return $this->southBoundLatitude;
    }

    /**
     * Set the value of southBoundLatitude.
     *
     *
     */
    public function setSouthBoundLatitude(float $southBoundLatitude): self
    {
        $this->southBoundLatitude = $southBoundLatitude;

        return $this;
    }

    /**
     * Get the value of northBoundLatitude.
     *
     */
    public function getNorthBoundLatitude(): float
    {
        return $this->northBoundLatitude;
    }

    /**
     * Set the value of northBoundLatitude.
     *
     *
     */
    public function setNorthBoundLatitude(float $northBoundLatitude): self
    {
        $this->northBoundLatitude = $northBoundLatitude;

        return $this;
    }
}
