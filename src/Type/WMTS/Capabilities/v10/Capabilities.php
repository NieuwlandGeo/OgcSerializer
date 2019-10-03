<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlNamespace;
use Nieuwland\OgcSerializer\Type\LayerCollectionInterface;
use function array_map;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wms")
 */
class Capabilities implements LayerCollectionInterface
{
    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Contents")
     *
     * @var Contents
     */
    protected $contents;

    /**
     * {@inheritdoc}
     */
    public function getLayerNames(): array
    {
        return array_map(static function (Layer $layer) {
            return $layer->getIdentifier();
        }, $this->contents->getLayers());
    }

    /**
     * Get the value of contents.
     */
    public function getContents(): Contents
    {
        return $this->contents;
    }
}
