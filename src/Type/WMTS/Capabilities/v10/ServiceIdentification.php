<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMTS\Capabilities\v10;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;

/**
 * @XmlNamespace(uri="http://www.opengis.net/ows/1.1")
 */
class ServiceIdentification
{
    /**
     * @var string
     *
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     */
    private $title;

    /**
     * @var string
     *
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     */
    private $abstract;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }
}
