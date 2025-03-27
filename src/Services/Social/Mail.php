<?php

namespace KiranoDev\LaravelApply\Services\Social;

use KiranoDev\LaravelApply\Contracts\ApplySender;
use KiranoDev\LaravelApply\Contracts\CanBeApply;
use KiranoDev\LaravelApply\DataTransferObjects\Providers\MailProvider;
use Illuminate\Support\Facades\Mail as MailFacade;

class Mail implements ApplySender
{
    static public function send(CanBeApply $apply): void
    {
        $data = $apply->getApplyData();

        /** @var MailProvider $provider */
        $provider = $data->provider;

        try {
            MailFacade::to($provider->to)
                ->send($provider->mail);
        } catch (\Exception $e) {
            info('Apply Failed: ' .$e->getMessage());
        }
    }
}