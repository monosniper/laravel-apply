<?php

namespace Monosniper\LaravelApply\Services\Social;

use Illuminate\Support\Facades\Http;
use Monosniper\LaravelApply\Contracts\ApplySender;
use Monosniper\LaravelApply\Contracts\CanBeApply;
use Monosniper\LaravelApply\DataTransferObjects\Providers\TelegramProvider;

class Telegram implements ApplySender
{
    const string NEXT_LINE = 'sep';

    static public function send(CanBeApply $apply): void
    {
        $data = $apply->getApplyData();

        /** @var TelegramProvider $provider */
        $provider = $data->provider;

        $token = $provider->bot_token;
        $chatIds = $provider->chat_ids;

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

        $url = fn ($chatId) => "https://api.telegram.org/bot$token/sendMessage?chat_id=$chatId&parse_mode=HTML&text=" . $message;

        try {
            foreach ($chatIds as $chatId) {
                Http::get($url($chatId));
            }
        } catch (\Exception $e) {
            info('Apply Failed: ' .$e->getMessage());
        }
    }
}