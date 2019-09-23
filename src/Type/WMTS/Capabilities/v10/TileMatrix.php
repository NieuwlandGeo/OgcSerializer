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
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Get the value of scaleDenominator.
     *
     */
    public function getScaleDenominator(): string
    {
        return $this->scaleDenominator;
    }

    /**
     * Set the value of scaleDenominator.
     *
     *
     */
    public function setScaleDenominator(string $scaleDenominator): self
    {
        $this->scaleDenominator = $scaleDenominator;

        return $this;
    }

    /**
     * Get the value of topLeftCorner.
     *
     */
    public function getTopLeftCorner(): string
    {
        return $this->topLeftCorner;
    }

    /**
     * Get the value of tileWidth.
     *
     */
    public function getTileWidth(): int
    {
        return $this->tileWidth;
    }

    /**
     * Get the value of tileHeight.
     *
     */
    public function getTileHeight(): int
    {
        return $this->tileHeight;
    }

    /**
     * Get the value of matrixWidth.
     *
     */
    public function getMatrixWidth(): int
    {
        return $this->matrixWidth;
    }

    /**
     * Get the value of matrixHeight.
     *
     */
    public function getMatrixHeight(): int
    {
        return $this->matrixHeight;
    }
}
