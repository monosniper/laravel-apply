<?php

namespace Monosniper\LaravelApply\DataTransferObjects\Providers;

use Monosniper\LaravelApply\DataTransferObjects\ApplyProvider;
use Monosniper\LaravelApply\Enums\Via;

class TelegramProvider extends ApplyProvider
{
    public function __construct(
        public ?array $chat_ids = null,
        public ?string $bot_token = null,
    ) {
        if(!$this->chat_ids) {
            $this->chat_ids = $this->getFallback(Via::TELEGRAM, 'chat_ids');
        }

        if(!$this->bot_token) {
            $this->bot_token = $this->getFallback(Via::TELEGRAM, 'bot_token');
        }
    }
}