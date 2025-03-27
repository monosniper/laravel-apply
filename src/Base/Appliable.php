<?php

namespace KiranoDev\laravelApply\Base;

use Illuminate\Database\Eloquent\Model;
use KiranoDev\LaravelApply\Contracts\CanBeApply;
use KiranoDev\laravelApply\DataTransferObjects\ApplyData;
use KiranoDev\LaravelApply\Enums\Via;
use KiranoDev\LaravelApply\Helpers\Formatter;

class Appliable extends Model implements CanBeApply
{
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