<?php

namespace KiranoDev\LaravelApply\Base;

use Illuminate\Database\Eloquent\Model;
use KiranoDev\LaravelApply\Contracts\CanBeApply;
use KiranoDev\LaravelApply\DataTransferObjects\ApplyData;
use KiranoDev\LaravelApply\Enums\Via;
use KiranoDev\LaravelApply\Helpers\Formatter;
use KiranoDev\LaravelApply\Services\Social\Log;
use KiranoDev\LaravelApply\Services\Social\Mail;
use KiranoDev\LaravelApply\Services\Social\Telegram;

class Appliable extends Model implements CanBeApply
{
    protected static function booted(): void
    {
        static::created(function (Appliable $appliable) {
            (match($appliable->via()) {
                Via::TELEGRAM => Telegram::class,
                Via::MAIL => Mail::class,
                Via::LOG => Log::class,
            })::send($appliable);
        });
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

    public function via(): Via
    {
        return Via::TELEGRAM;
    }
}