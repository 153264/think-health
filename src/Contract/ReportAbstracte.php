<?php

declare(strict_types=1);

namespace think\health\Contract;

use think\Collection;
use Throwable;

abstract class ReportAbstracte
{
    /**
     * @param Collection<string,Throwable|bool> $messages
     */
    abstract public function handle(Collection $messages): void;
}
