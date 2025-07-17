<?php

namespace Monosniper\LaravelApply\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Monosniper\LaravelApply\Contracts\CanBeApply;
use Monosniper\LaravelApply\Enums\Via;
use Monosniper\LaravelApply\Services\Social\Log;
use Monosniper\LaravelApply\Services\Social\Mail;
use Monosniper\LaravelApply\Services\Social\Telegram;

class SendApply implements ShouldQueue
{
    use Queueable, Dispatchable, SerializesModels;

    public function __construct(
        private readonly CanBeApply $apply,
        private readonly mixed $receiver
    ) {
    }

    public function handle(): void
    {
        (match($this->apply->applyVia()) {
            Via::TELEGRAM => Telegram::class,
            Via::MAIL => Mail::class,
            Via::LOG => Log::class,
        })::send($this->apply, $this->receiver);
    }
}
