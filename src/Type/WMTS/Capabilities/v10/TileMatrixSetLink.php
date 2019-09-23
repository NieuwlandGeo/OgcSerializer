<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\Type;

class TileMatrixSetLink
{
    /**
     * @Type("string")
     *
     * @var string
     */
    private $tileMatrixSet;

    /**
     * Get the value of tileMatrixSet.
     */
    public function getTileMatrixSet(): string
    {
        return $this->tileMatrixSet;
    }
}
