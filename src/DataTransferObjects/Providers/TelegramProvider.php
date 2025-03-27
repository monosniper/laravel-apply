<?php

namespace KiranoDev\laravelApply\DataTransferObjects\Providers;

use KiranoDev\laravelApply\DataTransferObjects\ApplyProvider;
use KiranoDev\LaravelApply\Enums\Via;

class TelegramProvider extends ApplyProvider
{
    public function __construct(
        public ?string $chat_id = null,
        public ?string $bot_token = null,
    ) {
        if(!$this->chat_id) {
            $this->chat_id = $this->getFallback(Via::TELEGRAM, 'chat_id');
        }

        if(!$this->bot_token) {
            $this->bot_token = $this->getFallback(Via::TELEGRAM, 'bot_token');
        }
    }
}