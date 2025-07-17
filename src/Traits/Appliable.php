<?php

namespace Monosniper\LaravelApply\Traits;

use Monosniper\LaravelApply\Contracts\CanBeApply;
use Monosniper\LaravelApply\Enums\Via;
use Monosniper\LaravelApply\Jobs\SendApply;

trait Appliable
{
    protected static function bootAppliable(): void
    {
        static::created(fn (CanBeApply $appliable) => $appliable->send());
    }

    public function sendTo(mixed $receiver): void
    {
        $target = is_array($receiver) ? $receiver[0] : $receiver;
        $delay = is_array($receiver) && isset($receiver[1]) && is_numeric($receiver[1])
            ? $receiver[1]
            : null;

        $job = new SendApply($this, $target);

        if ($delay) {
            $job->delay($delay);
        }

        dispatch($job);
    }

    public function send(): void
    {
        foreach ($this->getApplyData()->provider->receivers as $receiver) {
            if($this->skipApply($receiver)) continue;

            $this->sendTo($receiver);
        }
    }

    public function skipApply(mixed $receiver): bool
    {
        return false;
    }

    public function applyVia(): Via
    {
        return Via::TELEGRAM;
    }
}