<?php

declare(strict_types=1);

namespace think\health\Check;

use think\Exception;
use think\facade\Env;
use think\health\Contract\CheckAbstracte;

/**
 * 检查环境变量
 *
 * @date 2025-07-25
 * @example
 * @author lpf
 * @since 1.0.0
 */
class CheckEnv extends CheckAbstracte
{
    /**
     * @param array<string,string> $keys 需要检测的key值
     * @date 2025-08-04
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function __construct(
        private array $keys = [],
    ) {
    }

    public function name(): string
    {
        return 'CheckEnv';
    }

    public function handle(): void
    {
        $keys = $this->keys;
        foreach ($keys as $k => $v) {
            $this->checkKey($k, $v);
        }
    }

    private function checkKey(string $key, string $value): void
    {
        $env = Env::get($key);
        switch ($value) {
            case 'string':
                if (!is_string($env)) {
                    throw new Exception(
                        sprintf(
                            '%s is not string',
                            $key
                        )
                    );
                }
                break;
            case 'int':
                if (!is_numeric($env)) {
                    throw new Exception(
                        sprintf(
                            '%s is not int',
                            $key
                        )
                    );
                }
                break;
            case 'truthy':
                if (!$env) {
                    throw new Exception(
                        sprintf(
                            '%s is not truthy',
                            $key
                        )
                    );
                }
                break;
            case 'falsy':
                if ($env) {
                    throw new Exception(
                        sprintf(
                            '%s is not falsy',
                            $key
                        )
                    );
                }
                break;
            case 'bool':
                if (!is_bool($env)) {
                    throw new Exception(
                        sprintf(
                            '%s is not bool',
                            $key
                        )
                    );
                }
                break;
            default:
                if ($env !== $value) {
                    throw new Exception(
                        sprintf(
                            '%s is not %s',
                            $key,
                            $value
                        )
                    );
                }
                break;
        }
    }
}
