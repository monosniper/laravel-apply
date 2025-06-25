<?php

namespace Monosniper\LaravelApply\DataTransferObjects\Providers;

use Illuminate\Mail\Mailable;
use Monosniper\LaravelApply\DataTransferObjects\ApplyProvider;

class MailProvider extends ApplyProvider
{
    public function __construct(
        public Mailable $mail,
        public mixed $to,
    ) {}
}