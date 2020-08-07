<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200;

use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractOperation;

class Operation extends AbstractOperation
{
    /**
     * @var string
     *
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("name")
     */
    protected $name;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Parameter>")
     * @XmlList(inline=true, entry="Parameter", namespace="http://www.opengis.net/ows/1.1")
     * @AccessType("public_method")
     *
     * @var Parameter[]
     */
    protected $parameters;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Constraint>")
     * @XmlList(inline=true, entry="Constraint", namespace="http://www.opengis.net/ows/1.1")
     * @AccessType("public_method")
     *
     * @var Constraint[]
     */
    protected $constraints;

    /**
     * @param Parameter[] $parameters
     */
    public function setParameters(array $parameters): self
    {
        foreach ($parameters as $param) {
            $this->parameters[$param->getName()] = $param;
        }

        return $this;
    }

    /**
     * @return Parameter[]
     */
    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    public function getParameter(string $name): ?Parameter
    {
        return $this->parameters[$name] ?? null;
    }

    /**
     * @return Constraint[] $constraints
     */
    public function getConstraints(): array
    {
        return $this->constraints;
    }

    public function getConstraint(string $name): ?Constraint
    {
        return $this->constraints[$name] ?? null;
    }

    /**
     * @param Constraint[] $constraints
     */
    public function setConstraints(array $constraints): self
    {
        foreach ($constraints as $constraint) {
            $this->constraints[$constraint->getName()] = $constraint;
        }

        return $this;
    }
}
