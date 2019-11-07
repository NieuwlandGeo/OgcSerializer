<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

class LayerCapabilities implements LayerCapabilitiesInterface
{
    /** @var string */
    private $name;
    /** @var string */
    private $defaultCrs;
    /** @var string[] */
    private $dataFormats;
    /** @var string[] */
    private $projections;
    /** @var string[]|null */
    private $infoFormats;

    /**
     * @param string[] $dataFormats
     * @param string[] $projections
     */
    public function __construct(
        string $name,
        array $projections,
        ?string $defaultCrs = null,
        ?array $dataFormats = null,
        ?array $infoFormats = null
    ) {
        $this->name        = $name;
        $this->defaultCrs  = $defaultCrs;
        $this->dataFormats = $dataFormats;
        $this->projections = $projections;
        $this->infoFormats = $infoFormats;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDefaultCrs(): ?string
    {
        return $this->defaultCrs;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataFormats(): array
    {
        return $this->dataFormats;
    }

    /**
     * {@inheritdoc}
     */
    public function getFeatureInfoFormats(): ?array
    {
        return $this->infoFormats;
    }

    /**
     * {@inheritdoc}
     */
    public function getProjections(): array
    {
        return $this->projections;
    }
}
