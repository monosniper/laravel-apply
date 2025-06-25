<?php

namespace Monosniper\LaravelApply\Traits;

use Monosniper\LaravelApply\Contracts\CanBeApply;
use Monosniper\LaravelApply\DataTransferObjects\ApplyData;
use Monosniper\LaravelApply\Enums\Via;
use Monosniper\LaravelApply\Helpers\Formatter;
use Monosniper\LaravelApply\Services\Social\Log;
use Monosniper\LaravelApply\Services\Social\Mail;
use Monosniper\LaravelApply\Services\Social\Telegram;

trait Appliable
{
    protected static function bootAppliable(): void
    {
        static::created(function (CanBeApply $appliable) {
            if(!$appliable->skipApply()) {
                (match($appliable->applyVia()) {
                    Via::TELEGRAM => Telegram::class,
                    Via::MAIL => Mail::class,
                    Via::LOG => Log::class,
                })::send($appliable);
            }
        });
    }

    protected function skipApply(): bool
    {
        return false;
    }

    public function getApplyData(): ApplyData
    {
        return new ApplyData(
            data: [
                __('apply::name') => $this->name,
                __('apply::email') => $this->email,
                __('apply::phone') => Formatter::phone($this->phone),
            ],
        );
    }

    public function applyVia(): Via
    {
        return Via::TELEGRAM;
    }
}