<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

use Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10\ResourceUrl;

/**
 * Data Transfer objecto for (javascript) client.
 */
interface LayerCapabilitiesInterface
{
    /**
     * string to use in typeNames / layers url query param.
     */
    public function getName(): string;

    public function getTitle(): string;

    /**
     * for WFS.
     */
    public function getDefaultCrs(): ?string;

    /**
     * e.g. png for WMS, geojson for WFS.
     *
     * @return string[]|null
     */
    public function getDataFormats(): ?array;

    /**
     * WMS/WMTS.
     *
     * @return string[]|null
     */
    public function getFeatureInfoFormats(): ?array;

    /**
     * @return string[]
     */
    public function getProjections(): array;

    /**
     * @return ResourceUrl[]
     */
    public function getResourceUrl(): ?array;

    public function getMetadataUrl(): ?string;

    public function getMaxScaleDenominator(): ?float;

    public function getMinScaleDenominator(): ?float;
}
