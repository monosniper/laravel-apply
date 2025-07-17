<?php

namespace Monosniper\LaravelApply\DataTransferObjects\Providers;

use Monosniper\LaravelApply\Contracts\CanBeApply;
use Monosniper\LaravelApply\DataTransferObjects\ApplyProvider;

class TelegramProvider extends ApplyProvider
{
    public function __construct(
        public array $receivers,
        public string $bot_token,
    ) {
    }

    public function handle(CanBeApply $appliable): void
    {
        foreach ($this->receivers as $chat) {
            if($appliable->skipApply($chat)) continue;
        }
    }
}