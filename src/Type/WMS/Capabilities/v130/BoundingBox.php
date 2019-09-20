<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

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
     */
    public function getCRS(): string
    {
        return $this->CRS;
    }

    /**
     * Set the value of crs.
     *
     *
     */
    public function setCRS(string $crs): self
    {
        $this->CRS = $crs;

        return $this;
    }

    /**
     * Get the value of minx.
     *
     */
    public function getMinx(): float
    {
        return $this->minx;
    }

    /**
     * Set the value of minx.
     *
     *
     */
    public function setMinx(float $minx): self
    {
        $this->minx = $minx;

        return $this;
    }

    /**
     * Get the value of miny.
     *
     */
    public function getMiny(): float
    {
        return $this->miny;
    }

    /**
     * Set the value of miny.
     *
     *
     */
    public function setMiny(float $miny): self
    {
        $this->miny = $miny;

        return $this;
    }

    /**
     * Get the value of maxx.
     *
     */
    public function getMaxx(): float
    {
        return $this->maxx;
    }

    /**
     * Set the value of maxx.
     *
     *
     */
    public function setMaxx(float $maxx): self
    {
        $this->maxx = $maxx;

        return $this;
    }

    /**
     * Get the value of maxy.
     *
     */
    public function getMaxy(): float
    {
        return $this->maxy;
    }

    /**
     * Set the value of maxy.
     *
     *
     */
    public function setMaxy(float $maxy): self
    {
        $this->maxy = $maxy;

        return $this;
    }

    /**
     * Get the value of resx.
     *
     */
    public function getResx(): float
    {
        return $this->resx;
    }

    /**
     * Set the value of resx.
     *
     *
     */
    public function setResx(float $resx): self
    {
        $this->resx = $resx;

        return $this;
    }

    /**
     * Get the value of resy.
     *
     */
    public function getResy(): float
    {
        return $this->resy;
    }

    /**
     * Set the value of resy.
     *
     *
     */
    public function setResy(float $resy): self
    {
        $this->resy = $resy;

        return $this;
    }
}
