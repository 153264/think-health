<?php

declare(strict_types=1);

use think\health\Check\CheckCache;
use think\health\Check\CheckDataBase;
use think\health\Check\CheckEnv;
use think\health\Check\CheckFolder;
use think\health\Check\CheckHttp;
use think\health\Contract\CheckAbstracte;
use think\health\Contract\ReportAbstracte;
use think\health\Report\Http;

/**
 * 健康检查配置
 */
return [
    /**
     * 健康检查路由
     * @var string|bool
     */
    'url' => '/health',

    /**
     * 健康检查上报
     * 必须要继承 ReportAbstracte 类
     * @var array<ReportAbstracte>
     */
    'reportHandles' => [
        new Http(
            /**
             * 上报地址
             * @var string
             */
            url: 'https://your-server.com/health/report',
            /**
             * 超时时间
             * @var integer
             */
            timeout: 30,
        )
    ],
    /**
     * 监听器
     * 必须要继承 CheckAbstracte 类
     * @var array<CheckAbstracte>
     */
    'checkHandles' => [
        new CheckDataBase(
            /**
             * 需要检测的数据库连接
             * 如果为空，则检测所有数据库连接
             * @var array<string>
             */
            connections: []
        ),
        new CheckCache(
            /**
             * 需要检测的缓存
             * 如果为空，则检测所有缓存
             * @var array<string>
             */
            stores: [],
            /**
             * 缓存key
             * @var string
             */
            key: 'health_check_cache_key',
            /**
             * 缓存value
             * @var string
             */
            value: 'health_check_cache_value'
        ),
        new CheckEnv(
            /**
             * 需要检测的key值
             *
             * falsy 为空或0
             * truthy 为非空或非0
             * string 为字符串
             * int 为数字
             *
             * @var array<string,string>
             */
            keys: [
                'APP_DEBUG' => 'falsy',

                'DATABASE.TYPE' => 'mysql',
                'DATABASE.HOST' => 'string',
                'DATABASE.NAME' => 'string',
                'DATABASE.USER' => 'string',
                'DATABASE.PASS' => 'string',
                'DATABASE.PORT' => 'int',
                'DATABASE.CHARSET' => 'utf8mb4',
            ]
        ),
        new CheckFolder(
            /**
             * 需要检查的文件夹
             * 键为文件夹路径，值为允许的最大大小（字节）
             * @var array<string,int>
             */
            folders: [
                runtime_path() => 1024 * 1024 * 1024
            ]
        ),
        new CheckHttp(
            /**
             * 需要检查的网络资源
             * @var string
             */
            url: 'https://your-server.com/resource',
            /**
             * 超时时间
             * @var integer
             */
            timeout: 30,
            /**
             * 允许的HTTP状态码
             * @var array<integer>
             */
            statusCodes: [200, 201, 202, 204],
        )
    ],
];
