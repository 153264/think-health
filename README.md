# ThinkHealth - ThinkPHP 健康检查库

一个为 ThinkPHP 框架设计的健康检查库，支持自定义健康检查和灵活的配置选项。

## 功能特性

- 简单易用的健康检查接口
- 可自定义的健康检查
- 灵活的配置选项
- 支持使用命令行定时上报健康情况

## 安装

通过 Composer 安装：

```bash
composer require 153264/think-health
```

## 基本使用

安装后，健康检查接口会自动注册到你的应用中。默认情况下，你可以通过访问 `/health` 路径来进行健康检查：

```bash
curl http://your-domian/your-entrance/health
```

### 成功响应

```
HTTP/1.1 200 OK
Content-Type: text/html

ok
```

### 失败响应

```
HTTP/1.1 500 Internal Server Error
Content-Type: text/html

Database connection failed: SQLSTATE[HY000] [2002] Connection refused
```

## 配置选项

在 `config/health.php` 文件中配置健康检查行为：

```php
<?php

return [
    /**
     * 健康检查路由
     * @var string|bool
     */
    'url' => '/health',

    /**
     * 健康检查上报
     * @var array<ReportAbstracte>
     */
    'reportHandles' => [
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
    ],
];
```

## 创建自定义健康检查

你可以创建自定义的健康检查来检查特定的服务或资源：

```php
<?php

namespace app\check;

use think\health\Contract\CheckAbstracte;

class CheckApp extends CheckAbstracte
{
    public function name():string{
        return 'app检查';
    }

    public function handle():void
    {
        // check app
    }
}
```

然后在配置文件中添加这个检查：

```php
'checkHandles' => [
    // ... 其他监听器
    new \app\check\CheckApp()
],
```

## 内置检查

### CheckEnv

检查项目环境变量是否正确

### CheckDatabase

检查数据库连接是否正常

### CheckCache

检查缓存是否正常

### CheckFolder

检查文件夹大小是否正常

## 许可证

MIT License
