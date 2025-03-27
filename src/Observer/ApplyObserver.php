<?php

namespace KiranoDev\LaravelApply\Observers;

use KiranoDev\LaravelApply\Contracts\CanBeApply;
use KiranoDev\LaravelApply\Enums\Via;
use KiranoDev\LaravelApply\Services\Social\Log;
use KiranoDev\LaravelApply\Services\Social\Mail;
use KiranoDev\LaravelApply\Services\Social\Telegram;

class ApplyObserver
{
    public function created(CanBeApply $apply): void
    {
        (match($apply->via()) {
            Via::TELEGRAM => Telegram::class,
            Via::MAIL => Mail::class,
            Via::LOG => Log::class,
        })::send($apply);
    }
}