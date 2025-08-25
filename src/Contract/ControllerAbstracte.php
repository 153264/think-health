<?php

declare(strict_types=1);

namespace think\health\Contract;

use think\health\Checker;
use think\health\CheckResult;
use think\Response;

abstract class ControllerAbstracte
{
    abstract public function handle(): Response;

    protected function check(): CheckResult
    {
        $checkHealth = Checker::loadConfig();
        return $checkHealth->check();
    }
}
