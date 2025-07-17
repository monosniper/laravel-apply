<?php

namespace Monosniper\LaravelApply\Services\Social;

use Illuminate\Support\Facades\Http;
use Monosniper\LaravelApply\Contracts\ApplySender;
use Monosniper\LaravelApply\Contracts\CanBeApply;
use Monosniper\LaravelApply\DataTransferObjects\ApplyData;
use Monosniper\LaravelApply\DataTransferObjects\Providers\TelegramProvider;

class Telegram implements ApplySender
{
    const string NEXT_LINE = 'sep';
    const string API_URL = 'https://api.telegram.org/';

    public static function send(CanBeApply $apply, mixed $receiver): void
    {
        $data = $apply->getApplyData();
        $message = self::formatMessage($data);

        /** @var TelegramProvider $provider */
        $provider = $data->provider;
        $token = $provider->bot_token;

        try {
            Http::get(sprintf(
                "%sbot%s/sendMessage?chat_id=%s&parse_mode=HTML&text=%s",
                self::API_URL, $token, $receiver, $message
            ));
        } catch (\Exception $e) {
            info('Apply Failed: ' .$e->getMessage());
        }
    }

    public static function formatMessage(ApplyData $data): string
    {
        $_title = $data->title;
        $messageData = [
            $_title => '',
            self::NEXT_LINE,
            ...$data->data
        ];

        $lines = array_map(function ($key, $value) {
            return $value === self::NEXT_LINE ? "\n" : "<b>$key:</b> $value\n";
        }, array_keys($messageData), $messageData);

        return implode('', $lines);
    }
}
