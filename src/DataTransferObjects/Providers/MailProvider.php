<?php

namespace KiranoDev\laravelApply\DataTransferObjects\Providers;

use Illuminate\Mail\Mailable;
use KiranoDev\laravelApply\DataTransferObjects\ApplyProvider;

class MailProvider extends ApplyProvider
{
    public function __construct(
        public Mailable $mail,
        public mixed $to,
    ) {}
}