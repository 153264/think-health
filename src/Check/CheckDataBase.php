<?php

declare(strict_types=1);

namespace think\health\Check;

use think\Exception;
use think\facade\Config;
use think\facade\Db;
use think\health\Contract\CheckAbstracte;

/**
 * 检查数据库连接
 *
 * @date 2025-07-25
 * @example
 * @author lpf
 * @since 1.0.0
 */
class CheckDataBase extends CheckAbstracte
{
    /**
     * @param array<string> $connections 需要检测的数据库连接 如果为空，则检测所有数据库连接
     * @date 2025-08-04
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function __construct(
        private array $connections = [],
    ) {
    }

    public function name(): string
    {
        return 'CheckDataBase';
    }

    public function handle(): void
    {
        $connections = $this->getConnections();
        foreach ($connections as $connection) {
            try {
                $connect = Db::connect($connection);

                if (method_exists($connect, 'getTables')) {
                    $connect->getTables();
                } else {
                    throw new Exception('not support getTables method');
                }
            } catch (Exception $e) {
                throw new Exception(
                    sprintf(
                        '%s Database connection failed: %s',
                        $connection,
                        $e->getMessage()
                    )
                );
            } finally {
                if (isset($connect)) {
                    $connect->close();
                }
            }
        }
    }

    /**
     * @return array<string>
     * @date 2025-07-24
     * @example
     * @author lpf
     * @since 1.0.0
     */
    private function getConnections(): array
    {
        /**
         * @var array<string> $connections
         */
        $connections = $this->connections;
        if (empty($connections)) {
            /**
             * @var array<string,mixed> $connections
             */
            $connections = Config::get('database.connections', []);
            $connections = array_keys($connections);
        }
        return $connections;
    }
}
