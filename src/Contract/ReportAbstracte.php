<?php

declare(strict_types=1);

namespace think\health\Contract;

use think\health\CheckResult;

abstract class ReportAbstracte
{
    abstract public function handle(CheckResult $result): void;
}
