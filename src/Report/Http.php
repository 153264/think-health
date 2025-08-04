<?php

declare(strict_types=1);

namespace think\health\Report;

use think\Collection;
use think\health\Contract\ReportAbstracte;
use Throwable;

class Http extends ReportAbstracte
{
    /**
     * @param Collection<string,Throwable|bool> $messages
     * @return void
     * @date 2025-08-04
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function handle(Collection $messages): void
    {
    }
}
