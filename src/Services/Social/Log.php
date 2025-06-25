<?php

namespace Monosniper\LaravelApply\Services\Social;

use Monosniper\LaravelApply\Contracts\ApplySender;
use Monosniper\LaravelApply\Contracts\CanBeApply;

class Log implements ApplySender
{
    static public function send(CanBeApply $apply): void
    {
        info(json_encode($apply->getApplyData()));
    }
}