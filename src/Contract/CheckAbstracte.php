<?php

declare(strict_types=1);

namespace think\health\Contract;

abstract class CheckAbstracte
{
    abstract public function name(): string;

    abstract public function handle(): void;
}
