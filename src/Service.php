<?php

declare(strict_types=1);

namespace think\health;

use think\facade\Config;
use think\facade\Route;
use think\health\Command\Check;
use think\health\Contract\CheckAbstracte;
use think\Response;
use think\Service as ThinkService;

class Service extends ThinkService
{
    /**
     * 注册系统服务
     *
     * @return void
     * @date 2025-07-23
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function register(): void
    {
        $this->registerRoutes(function () {
            /**
             * @var string|bool $url
             */
            $url = Config::get('health.url');
            if ($url === false) {
                return;
            }
            if ($url === true || !$url) {
                $url = '/health';
            }
            Route::get($url, function () {
                return $this->checkHealth();
            });
        });
    }

    /**
     * 系统服务注册完成之后
     *
     * @return void
     * @date 2025-07-23
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function boot(): void
    {
        $this->commands([
            Check::class,
        ]);
    }

    private function checkHealth(): Response
    {
        /**
         * @var array<CheckAbstracte> $checkHandles
         */
        $checkHandles = Config::get('health.checkHandles');
        $checkHealth = new CheckHealth(
            $checkHandles,
            []
        );
        $checkHealth->check();
        $errors = $checkHealth->getErrorMessages();
        $isOk = $errors->isEmpty();
        return Response::create(
            $isOk ? 'ok' : ($this->app->isDebug() ? $errors : 'error'),
            'html',
            $isOk ? 500 : 200
        );
    }
}
