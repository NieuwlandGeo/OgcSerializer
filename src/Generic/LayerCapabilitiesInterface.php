<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

/**
 * Data Transfer objecto for (javascript) client.
 */
interface LayerCapabilitiesInterface
{
    /**
     * string to use in typeNames / layers url query param.
     */
    public function getName(): string;

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
}
