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
     * Get the value of layers.
     *
     * @return Layer[]
     */
    public function getLayers()
    {
        return $this->layers;
    }

    /**
     * Set the value of layers.
     *
     * @param array $layers
     *
     * @return self
     */
    public function setLayers(array $layers)
    {
        $this->layers = $layers;

        return $this;
    }
}
