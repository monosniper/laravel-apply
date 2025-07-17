<?php

namespace Monosniper\LaravelApply\Contracts;

use Monosniper\LaravelApply\DataTransferObjects\ApplyData;
use Monosniper\LaravelApply\Enums\Via;

interface CanBeApply
{
    public function getApplyData(): ApplyData;
    public function applyVia(): Via;
    public function skipApply(mixed $candidate): bool;
    public function send(): void;
}