<?php

use Monosniper\LaravelApply\Enums\Via;

return [
    'fallback' => [
        Via::TELEGRAM->value => [
            'receivers' => [],
            'bot_token' => '',
        ],
    ],
];