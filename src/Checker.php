<?php

declare(strict_types=1);

namespace think\health;

use think\facade\Config;
use think\health\Contract\CheckAbstracte;
use Throwable;

class Checker
{
    /**
     * @param array<CheckAbstracte> $checkHandles
     */
    public function __construct(
        private array $checkHandles,
    ) {
    }

    public static function loadConfig(): self
    {
        /**
         * @var array<CheckAbstracte> $checkHandles
         */
        $checkHandles = Config::get('health.checkHandles', []);
        return new self(
            $checkHandles,
        );
    }

    public function check(): CheckResult
    {
        $result = new CheckResult();
        foreach ($this->checkHandles as $checkHandle) {
            $name = $checkHandle->name();
            try {
                $checkHandle->handle();
                $result->set($name, true);
            } catch (Throwable $th) {
                $result->set($name, $th);
            }
        }
        return $result;
    }
}
