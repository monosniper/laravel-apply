<?php

namespace Monosniper\LaravelApply\Contracts;

use Illuminate\Database\Eloquent\Model;
use Monosniper\LaravelApply\DataTransferObjects\ApplyData;
use Monosniper\LaravelApply\Enums\Via;

interface CanBeApply
{
    public function getApplyData(?Model $user = null): ApplyData;
    public function applyVia(): Via;
    public function skipApply(mixed $receiver): bool;
    public function send(): void;
}