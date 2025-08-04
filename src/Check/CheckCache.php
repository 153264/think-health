<?php

declare(strict_types=1);

namespace think\health\Check;

use think\Exception;
use think\facade\Cache;
use think\health\Contract\CheckAbstracte;

/**
 * 检查缓存
 *
 * @date 2025-07-25
 * @example
 * @author lpf
 * @since 1.0.0
 */
class CheckCache extends CheckAbstracte
{
    /**
     * @param array<string> $stores 需要检测的缓存 如果为空，则检测所有缓存
     * @param string $key 缓存key
     * @param string $value 缓存value
     * @date 2025-08-04
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function __construct(
        private array $stores = [],
        private string $key = 'health_check_cache_key',
        private string $value = 'health_check_cache_value',
    ) {
    }

    public function name(): string
    {
        return '检查缓存';
    }

    public function handle(): void
    {
        $stores = $this->stores;
        $key = $this->key;
        $value = $this->value;
        foreach ($stores as $store) {
            $cache = Cache::store($store);
            $cache->set($key, $value);
            if ($cache->get($key) !== $value) {
                throw new Exception(
                    sprintf(
                        'cache %s is not set',
                        $store
                    )
                );
            }
            $cache->delete($key);
        }
    }
}
