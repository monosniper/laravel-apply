<?php

namespace Monosniper\LaravelApply\Enums;

enum Via: string
{
    use BaseEnum;

    case TELEGRAM = 'telegram';
    case MAIL = 'mail';
    case LOG = 'log';
}
