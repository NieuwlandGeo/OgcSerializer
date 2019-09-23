<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class Layer
{
    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var string
     */
    protected $title;
    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var string
     */
    protected $abstract;
    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var string
     */
    protected $identifier;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Style>")
     * @XmlList(inline=true, entry="Style")
     *
     * @var Style[]
     */
    protected $styles;

    /**
     * @Type("array<string>")
     * @XmlList(inline=true, entry="Format")
     *
     * @var string[]
     */
    protected $formats;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\TileMatrixSetLink>")
     * @XmlList(inline=true, entry="TileMatrixSetLink")
     *
     * @var TileMatrixSetLink[]
     */
    protected $tileMatrixSetLinks;

    /**
     * Get the value of title.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get the value of abstract.
     */
    public function getAbstract(): string
    {
        return $this->abstract;
    }

    /**
     * Get the value of identifier.
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Get the value of tileMatrixSetLinks.
     *
     * @return TileMatrixSetLink[]
     */
    public function getTileMatrixSetLinks(): array
    {
        return $this->tileMatrixSetLinks;
    }

    /**
     * Get the value of styles.
     *
     * @return Style[]
     */
    public function getStyles(): array
    {
        return $this->styles;
    }

    /**
     * Get the value of formats.
     *
     * @return string[]
     */
    public function getFormats(): array
    {
        return $this->formats;
    }
}
