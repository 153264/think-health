<?php

declare(strict_types=1);

namespace think\health\Check;

use think\health\Contract\CheckAbstracte;

/**
 * 检查网络资源
 *
 * @date 2025-07-25
 * @example
 * @author lpf
 * @since 1.0.0
 */
class CheckHttp extends CheckAbstracte
{
    public function name(): string
    {
        return '检查网络资源';
    }

    public function handle(): void
    {
    }
}
