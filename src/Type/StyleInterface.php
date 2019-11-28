<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type;

/**
 * interface for layers with named styles.
 */
interface StyleInterface
{
    /**
     * @return string[] keyed by identifier
     */
    public function getStyleNames(): array;
}
