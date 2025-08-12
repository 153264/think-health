<?php

declare(strict_types=1);

namespace think\health;

use think\facade\Config;
use think\facade\Route;
use think\health\Command\Check;
use think\health\Contract\ControllerAbstracte;
use think\health\Controller\ControllerText;
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
            $url = Config::get(
                'health.registerRoute.url',
                '/health'
            );
            if ($url === false) {
                return;
            }
            if ($url === true) {
                $url = '/health';
            }
            /**
             * @var ControllerAbstracte $controller
             */
            $controller = Config::get(
                'health.registerRoute.controller'
            );
            if (!$controller) {
                $controller = new ControllerText();
            }
            Route::get($url, static function () use ($controller) {
                return $controller->handle();
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
}
