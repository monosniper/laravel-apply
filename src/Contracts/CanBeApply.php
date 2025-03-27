<?php

namespace KiranoDev\LaravelApply\Contracts;

use KiranoDev\laravelApply\DataTransferObjects\ApplyData;
use KiranoDev\LaravelApply\Enums\Via;

interface CanBeApply
{
    public function getApplyData(): ApplyData;
    public function via(): Via;
}