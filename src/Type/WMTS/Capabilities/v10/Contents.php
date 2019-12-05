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
     * @AccessType("public_method")
     *
     * @var TileMatrixSet[]
     */
    protected $tileMatrixSets = [];

    /**
     * @return Layer[]
     */
    public function getLayers(): array
    {
        return $this->layers;
    }

    /**
     * @param Layer[] $layers
     */
    public function setLayers(array $layers): self
    {
        foreach ($layers as $layer) {
            $this->layers[$layer->getIdentifier()] = $layer;
        }

        return $this;
    }

    /**
     * @return TileMatrixSet[]
     */
    public function getTileMatrixSets(): array
    {
        return $this->tileMatrixSets;
    }

    /**
     * @param TileMatrixSet[] $tileMatrixSets
     */
    public function setTileMatrixSets(array $tileMatrixSets): self
    {
        foreach ($tileMatrixSets as $set) {
            $this->tileMatrixSets[$set->getIdentifier()] = $set;
        }

        return $this;
    }

    public function getTileMatrixSet(string $identifier): TileMatrixSet
    {
        return $this->tileMatrixSets[$identifier];
    }
}
