<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * WMS Capabilities Service.
 *
 * @XmlRoot("Service")
 */
class Service
{
    /**
     * @var string
     *
     * @Type("string")
     *
     * @XmlElement(cdata=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $title;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $abstract;

    /**
     * Get the value of name.
     *
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     *
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of title.
     *
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title.
     *
     *
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of abstract.
     *
     */
    public function getAbstract(): string
    {
        return $this->abstract;
    }

    /**
     * Set the value of abstract.
     *
     *
     */
    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }
}
