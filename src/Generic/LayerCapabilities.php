<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic;

class LayerCapabilities implements LayerCapabilitiesInterface
{
    /** @var string */
    private $name;
    /** @var string */
    private $title;
    /** @var string */
    private $defaultCrs;
    /** @var string[] */
    private $dataFormats;
    /** @var string[] */
    private $projections;
    /** @var string[]|null */
    private $infoFormats;
    /** @var string[]|null */
    private $resourceUrl;

    /**
     * @param string[] $projections
     * @param string[] $dataFormats
     * @param string[] $infoFormats
     */
    public function __construct(
        string $name,
        array $projections,
        ?string $title = null,
        ?string $defaultCrs = null,
        ?array $dataFormats = null,
        ?array $infoFormats = null,
        ?array $resourceUrl = null
    ) {
        $this->name        = $name;
        $this->title       = $title;
        $this->defaultCrs  = $defaultCrs;
        $this->dataFormats = $dataFormats;
        $this->projections = $projections;
        $this->infoFormats = $infoFormats;
        $this->resourceUrl = $resourceUrl;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTitle(): string
    {
        return $this->title ?? $this->getName();
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

    /**
     * {@inheritdoc}
     */
    public function getResourceUrl(): ?array
    {
        return $this->resourceUrl;
    }
}
