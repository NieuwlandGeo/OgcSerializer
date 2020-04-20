<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic\Transformers;

use Nieuwland\OgcSerializer\Generic\ServiceCapabilities;

interface TransformerInterface
{
    /**
     * @param mixed $data
     */
    public function transform($data): ServiceCapabilities;
}
