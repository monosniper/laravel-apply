<?php

use Monosniper\LaravelApply\Enums\Via;

return [
    'fallback' => [
        Via::TELEGRAM->value => [
            'chat_id' => '',
            'bot_token' => '',
        ],
    ],
];