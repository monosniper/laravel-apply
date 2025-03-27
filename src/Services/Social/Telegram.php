<?php

namespace KiranoDev\LaravelApply\Services\Social;

use Illuminate\Support\Facades\Http;
use KiranoDev\LaravelApply\Contracts\ApplySender;
use KiranoDev\LaravelApply\Contracts\CanBeApply;
use KiranoDev\laravelApply\DataTransferObjects\Providers\TelegramProvider;

class Telegram implements ApplySender
{
    const string NEXT_LINE = 'sep';

    static public function send(CanBeApply $apply): void
    {
        $data = $apply->getApplyData();

        /** @var TelegramProvider $provider */
        $provider = $data->provider;

        $token = $provider->bot_token;
        $chatId = $provider->chat_id;

        $message = "";

        $_title = $data->title;
        $messageData = [
            $_title => '',
            self::NEXT_LINE,
            ...$data->data
        ];

        foreach ($messageData as $key => $value) {
            $message .= $value === self::NEXT_LINE ? "\n" : "<b>" . $key . ":</b> " . $value . "\n";
        }

        $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chatId&parse_mode=HTML&text=" . $message;

        try {
            Http::get($url);
        } catch (\Exception $e) {
            info('Apply Failed: ' .$e->getMessage());
        }
    }
}