<?php

namespace KiranoDev\LaravelApply\DataTransferObjects;

use KiranoDev\LaravelApply\DataTransferObjects\Providers\TelegramProvider;

class ApplyData
{
    public function __construct(
        public ?string $title = null,
        public array $data = [],
        public ?ApplyProvider $provider = null,
    ) {
        if(!$this->provider) {
            $this->provider = new TelegramProvider();
        }

        if(!$this->title) {
            $this->title = __('apply::title');
        }
    }
}