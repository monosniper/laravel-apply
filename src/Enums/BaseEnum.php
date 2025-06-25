<?php

namespace Monosniper\LaravelApply\Enums;

trait BaseEnum
{
    static public function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
