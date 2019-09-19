<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\Type;

class Layer
{
    /**
     * @Type("string")
     *
     * @var string
     */
    protected $title;
    /**
     * @Type("string")
     *
     * @var string
     */
    protected $abstract;
    /**
     * @Type("string")
     *
     * @var string
     */
    protected $identifier;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\Style>")
     *
     * @var Style[]
     */
    protected $styles;

    /**
     * @Type("array<string>")
     *
     * @var string[]
     */
    protected $formats;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\TileMatrixSetLink>")
     *
     * @var TileMatrixSetLink[]
     */
    protected $tileMatrixSetLinks;

    /**
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of abstract.
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

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
     * Get the value of tileMatrixSetLinks.
     *
     * @return TileMatrixSetLink[]
     */
    public function getTileMatrixSetLinks()
    {
        return $this->tileMatrixSetLinks;
    }

    /**
     * Get the value of styles.
     *
     * @return Style[]
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Get the value of formats.
     *
     * @return string[]
     */
    public function getFormats()
    {
        return $this->formats;
    }
}
