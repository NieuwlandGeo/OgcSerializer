<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

interface LayerCapabilitiesInterface
{
    public function getName(): string;

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
