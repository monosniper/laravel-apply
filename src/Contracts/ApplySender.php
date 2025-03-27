<?php

namespace KiranoDev\LaravelApply\Contracts;

interface ApplySender
{
    static public function send(CanBeApply $apply): void;
}