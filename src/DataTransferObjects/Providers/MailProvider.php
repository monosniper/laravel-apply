<?php

namespace KiranoDev\LaravelApply\DataTransferObjects\Providers;

use Illuminate\Mail\Mailable;
use KiranoDev\LaravelApply\DataTransferObjects\ApplyProvider;

class MailProvider extends ApplyProvider
{
    public function __construct(
        public Mailable $mail,
        public mixed $to,
    ) {}
}