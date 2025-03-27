<?php

namespace KiranoDev\LaravelApply\Helpers;

class Formatter
{
    public static function phone(string $value): string
    {
        $phoneNumber = preg_replace('/\D/', '', $value);

        if (strlen($phoneNumber) == 12 && str_starts_with($phoneNumber, '998')) {
            return '+' . substr($phoneNumber, 0, 3) . ' (' . substr($phoneNumber, 3, 2) . ') ' . substr($phoneNumber, 5, 3) . '-' . substr($phoneNumber, 8, 2) . '-' . substr($phoneNumber, 10, 2);
        }

        return '-';
    }
}