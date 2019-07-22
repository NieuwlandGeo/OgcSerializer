<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities;

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
     * @return float
     */
    public function getWestBoundLongitude()
    {
        return $this->westBoundLongitude;
    }

    /**
     * Set the value of westBoundLongitude.
     *
     * @param float $westBoundLongitude
     *
     * @return self
     */
    public function setWestBoundLongitude(float $westBoundLongitude)
    {
        $this->westBoundLongitude = $westBoundLongitude;

        return $this;
    }

    /**
     * Get the value of eastBoundLongitude.
     *
     * @return float
     */
    public function getEastBoundLongitude()
    {
        return $this->eastBoundLongitude;
    }

    /**
     * Set the value of eastBoundLongitude.
     *
     * @param float $eastBoundLongitude
     *
     * @return self
     */
    public function setEastBoundLongitude(float $eastBoundLongitude)
    {
        $this->eastBoundLongitude = $eastBoundLongitude;

        return $this;
    }

    /**
     * Get the value of southBoundLatitude.
     *
     * @return float
     */
    public function getSouthBoundLatitude()
    {
        return $this->southBoundLatitude;
    }

    /**
     * Set the value of southBoundLatitude.
     *
     * @param float $southBoundLatitude
     *
     * @return self
     */
    public function setSouthBoundLatitude(float $southBoundLatitude)
    {
        $this->southBoundLatitude = $southBoundLatitude;

        return $this;
    }

    /**
     * Get the value of northBoundLatitude.
     *
     * @return float
     */
    public function getNorthBoundLatitude()
    {
        return $this->northBoundLatitude;
    }

    /**
     * Set the value of northBoundLatitude.
     *
     * @param float $northBoundLatitude
     *
     * @return self
     */
    public function setNorthBoundLatitude(float $northBoundLatitude)
    {
        $this->northBoundLatitude = $northBoundLatitude;

        return $this;
    }
}
