<?php

namespace KiranoDev\LaravelApply\Helpers;

class Formatter
{
    public static function phone(string $value): string
    {
        $originalPhoneNumber = $value;

        $phoneNumber = preg_replace('/\D/', '', $value);

        if (strlen($phoneNumber) >= 10 && strlen($phoneNumber) <= 15) {
            $formattedPhone = '';

            if (substr($phoneNumber, 0, 3) === '998') {
                $formattedPhone = '+' . substr($phoneNumber, 0, 3) . ' (' . substr($phoneNumber, 3, 2) . ') ' . substr($phoneNumber, 5, 3) . '-' . substr($phoneNumber, 8, 2) . '-' . substr($phoneNumber, 10, 2);
            }
            else if (substr($phoneNumber, 0, 1) === '7') {
                $formattedPhone = '+' . substr($phoneNumber, 0, 1) . ' (' . substr($phoneNumber, 1, 3) . ') ' . substr($phoneNumber, 4, 3) . '-' . substr($phoneNumber, 7, 2) . '-' . substr($phoneNumber, 9, 2);
            }
            else if (substr($phoneNumber, 0, 1) === '1') {
                $formattedPhone = '+' . substr($phoneNumber, 0, 1) . ' (' . substr($phoneNumber, 1, 3) . ') ' . substr($phoneNumber, 4, 3) . '-' . substr($phoneNumber, 7, 4);
            }
            else {
                $formattedPhone = '+' . substr($phoneNumber, 0, 1) . ' ' . substr($phoneNumber, 1);
            }

            return $formattedPhone;
        }

        return $originalPhoneNumber;
    }
}