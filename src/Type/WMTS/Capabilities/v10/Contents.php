<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

class Contents
{
    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Layer>")
     * @XmlList(inline=true, entry="Layer")
     * @AccessType("public_method")
     *
     * @var Layer[]
     */
    protected $layers;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\TileMatrixSet>")
     * @XmlList(inline=true, entry="TileMatrixSet")
     *
     * @var TileMatrixSet[]
     */
    protected $tileMatrixSets;

    /**
     * Get the value of layers.
     *
     * @return Layer[]
     */
    public function getLayers(): array
    {
        return $this->layers;
    }

    /**
     * Set the value of layers.
     *
     * @param Layer[] $layers
     *
     */
    public function setLayers(array $layers): self
    {
        $this->layers = $layers;

        return $this;
    }

    /**
     * Get the value of tileMatrixSet.
     *
     * @return TileMatrixSet[]
     */
    public function getTileMatrixSets(): array
    {
        return $this->tileMatrixSets;
    }
}
