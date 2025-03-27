<?php

namespace KiranoDev\LaravelApply\Services\Social;

use KiranoDev\LaravelApply\Contracts\ApplySender;
use KiranoDev\LaravelApply\Contracts\CanBeApply;

class Log implements ApplySender
{
    static public function send(CanBeApply $apply): void
    {
        info(json_encode($apply->getApplyData()));
    }
}