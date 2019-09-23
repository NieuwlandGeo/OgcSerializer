<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class TileMatrixSet
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
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var string
     */
    private $supportedCRS;
    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\TileMatrix>")
     * @XmlList(inline=true, entry="TileMatrix")
     *
     * @var TileMatrix[]
     */
    private $tileMatrixes;

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
     * Get the value of supportedCRS.
     *
     * @return string
     */
    public function getSupportedCRS()
    {
        return $this->supportedCRS;
    }

    /**
     * Get the value of tileMatrixes.
     *
     * @return TileMatrix[]
     */
    public function getTileMatrixes(): array
    {
        return $this->tileMatrixes;
    }

    /**
     * Set the value of tileMatrixes.
     *
     * @param TileMatrix[] $tileMatrixes
     *
     * @return self
     */
    public function setTileMatrixes(array $tileMatrixes)
    {
        $this->tileMatrixes = $tileMatrixes;

        return $this;
    }
}
