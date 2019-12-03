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
     * @Type("float")
     *
     * @var float
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

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getScaleDenominator(): float
    {
        return $this->scaleDenominator;
    }

    public function setScaleDenominator(float $scaleDenominator): self
    {
        $this->scaleDenominator = $scaleDenominator;

        return $this;
    }

    public function getTopLeftCorner(): string
    {
        return $this->topLeftCorner;
    }

    public function getTileWidth(): int
    {
        return $this->tileWidth;
    }

    public function getTileHeight(): int
    {
        return $this->tileHeight;
    }

    public function getMatrixWidth(): int
    {
        return $this->matrixWidth;
    }

    public function getMatrixHeight(): int
    {
        return $this->matrixHeight;
    }
}
