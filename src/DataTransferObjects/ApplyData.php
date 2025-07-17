<?php

namespace Monosniper\LaravelApply\DataTransferObjects;

class ApplyData
{
    public function __construct(
        public ?string $title = null,
        public array $data = [],
        public ApplyProvider $provider,
    ) {
        if(!$this->title) {
            $this->title = __('apply::title');
        }
    }
}