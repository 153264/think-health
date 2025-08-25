<?php

declare(strict_types=1);

namespace think\health;

use think\facade\Config;
use think\health\Contract\ReportAbstracte;

class Reporter
{
    /**
     * @param array<ReportAbstracte> $reportHandles
     */
    public function __construct(
        private array $reportHandles,
    ) {
    }

    public static function loadConfig(): self
    {
        /**
         * @var array<ReportAbstracte> $reportHandles
         */
        $reportHandles = Config::get('health.reportHandles', []);
        return new self(
            $reportHandles,
        );
    }

    public function report(CheckResult $result): void
    {
        foreach ($this->reportHandles as $reportHandle) {
            $reportHandle->handle($result);
        }
    }
}
