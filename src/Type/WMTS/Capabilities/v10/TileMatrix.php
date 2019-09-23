<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TileMatrix
{
    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var string
     */
    private $identifier;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $scaleDenominator;
    /**
     * @Type("string")
     *
     * @var string
     */
    private $topLeftCorner;
    /**
     * @Type("integer")
     *
     * @var int
     */
    private $tileWidth;
    /**
     * @Type("integer")
     *
     * @var int
     */
    private $tileHeight;
    /**
     * @Type("integer")
     *
     * @var int
     */
    private $matrixWidth;
    /**
     * @Type("integer")
     *
     * @var int
     */
    private $matrixHeight;

    /**
     * Get the value of identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Get the value of scaleDenominator.
     *
     * @return string
     */
    public function getScaleDenominator()
    {
        return $this->scaleDenominator;
    }

    /**
     * Set the value of scaleDenominator.
     *
     * @param string $scaleDenominator
     *
     * @return self
     */
    public function setScaleDenominator(string $scaleDenominator)
    {
        $this->scaleDenominator = $scaleDenominator;

        return $this;
    }

    /**
     * Get the value of topLeftCorner.
     *
     * @return string
     */
    public function getTopLeftCorner()
    {
        return $this->topLeftCorner;
    }

    /**
     * Get the value of tileWidth.
     *
     * @return int
     */
    public function getTileWidth()
    {
        return $this->tileWidth;
    }

    /**
     * Get the value of tileHeight.
     *
     * @return int
     */
    public function getTileHeight()
    {
        return $this->tileHeight;
    }

    /**
     * Get the value of matrixWidth.
     *
     * @return int
     */
    public function getMatrixWidth()
    {
        return $this->matrixWidth;
    }

    /**
     * Get the value of matrixHeight.
     *
     * @return int
     */
    public function getMatrixHeight()
    {
        return $this->matrixHeight;
    }
}
