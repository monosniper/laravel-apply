<?php

namespace KiranoDev\LaravelApply\Traits;

use KiranoDev\LaravelApply\Contracts\CanBeApply;
use KiranoDev\LaravelApply\DataTransferObjects\ApplyData;
use KiranoDev\LaravelApply\Enums\Via;
use KiranoDev\LaravelApply\Helpers\Formatter;
use KiranoDev\LaravelApply\Services\Social\Log;
use KiranoDev\LaravelApply\Services\Social\Mail;
use KiranoDev\LaravelApply\Services\Social\Telegram;

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