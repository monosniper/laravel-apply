<?php

namespace KiranoDev\laravelApply\DataTransferObjects;

use KiranoDev\LaravelApply\Enums\Via;

class ApplyProvider
{
    protected function getFallback(Via $via, string $key): ?string
    {
        return config('apply::fallback')[$via->value][$key] ?? null;
    }
}