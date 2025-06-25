<?php

namespace Monosniper\LaravelApply\DataTransferObjects;

use Monosniper\LaravelApply\Enums\Via;

class ApplyProvider
{
    protected function getFallback(Via $via, string $key): ?string
    {
        return config('apply::fallback')[$via->value][$key] ?? null;
    }
}