<?php

namespace KiranoDev\laravelApply\DataTransferObjects;

use KiranoDev\laravelApply\DataTransferObjects\Providers\TelegramProvider;

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