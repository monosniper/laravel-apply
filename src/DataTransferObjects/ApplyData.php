<?php

namespace KiranoDev\LaravelApply\DataTransferObjects;

use KiranoDev\LaravelApply\DataTransferObjects\Providers\TelegramProvider;

class ApplyData
{
    public function __construct(
        public ?ApplyProvider $provider = null,
        public array $data = [],
        public ?string $title = null,
    ) {
        if(!$this->provider) {
            $this->provider = new TelegramProvider();
        }

        if(!$this->title) {
            $this->title = __('apply::title');
        }
    }
}