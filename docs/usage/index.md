---
outline: deep
---

# think-health

think-health 是一个开源的 [ThinkPHP](https://www.thinkphp.cn/) 非官方 SDK。<br/>
安装非常简单，因为它是一个标准的 [Composer](https://getcomposer.org/) 包，这意味着任何满足下列安装条件的 PHP 项目支持 Composer 都可以使用它。

## 环境需求

- PHP >= 8.2
- [PHP cURL 扩展](http://php.net/manual/en/book.curl.php)
- [ThinkPHP 8.x](https://doc.thinkphp.cn/v8_0/preface.html)

## 安装

::: warning
不建议使用第三方的 Composer 源<br/>
请使用 [官方源](https://packagist.org/) 安装
:::

```shell:no-line-numbers
composer require 153264/think-health
```

## 使用

### http 检查

默认情况下，你可以通过访问 `/health` 路径来进行健康检查：

:::warning
开启调试模式时，接口会返回详细的异常服务和信息<br/>
生产环境请一定要关闭调试模式

```bash
curl http://your-domian/your-entrance/health

# 服务异常
HTTP/1.1 500 Internal Server Error
Content-Type: text/html

{"CheckEnv":"APP_DEBUG is not falsy","CheckCache":"health_check_cache_key is not set"}
```

:::

```bash
curl http://your-domian/your-entrance/health

# 服务正常
HTTP/1.1 200 OK
Content-Type: text/html

ok

# 服务异常
HTTP/1.1 500 Internal Server Error
Content-Type: text/html

error
```

### 命令行 检查

你可以使用 `health:check` 进行健康检查。<br/>
默认不进行上报，如果需要上报可以使用 `--report` 选项

```bash
php think health:check

# 服务正常
ok

# 服务异常
CheckEnv APP_DEBUG is not falsy
CheckCache health_check_cache_key is not set
```

## 开始之前

在你动手写代码之前，建议您首先阅读以下内容：

- [配置](./config.md)

## 参与贡献

我们欢迎广大开发者贡献大家的智慧，让我们共同让它变得更完美。
您可以在 GitHub 上提交 Pull Request，我们会尽快审核并公布。更多信息请参考 [贡献指南](/contributing.md)。
