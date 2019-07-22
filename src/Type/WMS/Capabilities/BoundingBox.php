<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

/**
 * Base on WMS 1.3.0 BoundingBox.
 */
class BoundingBox
{
    /**
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    private $CRS;

    /**
     * @Type("float")
     * @XmlAttribute
     * @SerializedName("minx")
     *
     * @var float
     */
    private $minx;

    /**
     * @Type("float")
     * @XmlAttribute
     * @SerializedName("miny")
     *
     * @var float
     */
    private $miny;

    /**
     * @Type("float")
     * @XmlAttribute
     * @SerializedName("maxx")
     *
     * @var float
     */
    private $maxx;

    /**
     * @Type("float")
     * @XmlAttribute
     * @SerializedName("maxy")
     *
     * @var float
     */
    private $maxy;

    /**
     * @Type("float")
     * @XmlAttribute
     * @SerializedName("resx")
     *
     * @var float
     */
    private $resx;
    /**
     * @Type("float")
     * @XmlAttribute
     * @SerializedName("resy")
     *
     * @var float
     */
    private $resy;

    /**
     * Get the value of crs.
     *
     * @return string
     */
    public function getCRS()
    {
        return $this->CRS;
    }

    /**
     * Set the value of crs.
     *
     * @param string $crs
     *
     * @return self
     */
    public function setCRS(string $crs)
    {
        $this->CRS = $crs;

        return $this;
    }

    /**
     * Get the value of minx.
     *
     * @return float
     */
    public function getMinx()
    {
        return $this->minx;
    }

    /**
     * Set the value of minx.
     *
     * @param float $minx
     *
     * @return self
     */
    public function setMinx(float $minx)
    {
        $this->minx = $minx;

        return $this;
    }

    /**
     * Get the value of miny.
     *
     * @return float
     */
    public function getMiny()
    {
        return $this->miny;
    }

    /**
     * Set the value of miny.
     *
     * @param float $miny
     *
     * @return self
     */
    public function setMiny(float $miny)
    {
        $this->miny = $miny;

        return $this;
    }

    /**
     * Get the value of maxx.
     *
     * @return float
     */
    public function getMaxx()
    {
        return $this->maxx;
    }

    /**
     * Set the value of maxx.
     *
     * @param float $maxx
     *
     * @return self
     */
    public function setMaxx(float $maxx)
    {
        $this->maxx = $maxx;

        return $this;
    }

    /**
     * Get the value of maxy.
     *
     * @return float
     */
    public function getMaxy()
    {
        return $this->maxy;
    }

    /**
     * Set the value of maxy.
     *
     * @param float $maxy
     *
     * @return self
     */
    public function setMaxy(float $maxy)
    {
        $this->maxy = $maxy;

        return $this;
    }

    /**
     * Get the value of resx.
     *
     * @return float
     */
    public function getResx()
    {
        return $this->resx;
    }

    /**
     * Set the value of resx.
     *
     * @param float $resx
     *
     * @return self
     */
    public function setResx(float $resx)
    {
        $this->resx = $resx;

        return $this;
    }

    /**
     * Get the value of resy.
     *
     * @return float
     */
    public function getResy()
    {
        return $this->resy;
    }

    /**
     * Set the value of resy.
     *
     * @param float $resy
     *
     * @return self
     */
    public function setResy(float $resy)
    {
        $this->resy = $resy;

        return $this;
    }
}
