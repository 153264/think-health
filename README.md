# [ThinkHealth](https://153264.github.io/think-health/)

📦 一个为 [ThinkPHP](https://github.com/top-think/think) 框架设计的健康检查库，支持自定义健康检查和灵活的配置选项。

[![Lint Status](https://github.com/153264/think-health/workflows/Lint/badge.svg)](https://github.com/153264/think-health/actions)
[![Latest Stable Version](https://poser.pugx.org/153264/think-health/v/stable.svg)](https://packagist.org/packages/153264/think-health)
[![Latest Unstable Version](https://poser.pugx.org/153264/think-health/v/unstable.svg)](https://packagist.org/packages/153264/think-health)
[![Total Downloads](https://poser.pugx.org/153264/think-health/downloads)](https://packagist.org/packages/153264/think-health)
[![License](https://poser.pugx.org/153264/think-health/license)](https://packagist.org/packages/153264/think-health)

## 功能特性

- 简单易用的健康检查接口
- 可自定义的健康检查
- 灵活的配置选项
- 支持使用命令行定时上报健康情况

## 环境需求

- PHP >= 8.2.0
- [Composer](https://getcomposer.org/) >= 2.0

## 安装

```bash
composer require 153264/think-health
```

## 使用示例

安装后，健康检查接口会自动注册到你的应用中。
默认情况下，你可以通过访问 `/health` 路径来进行健康检查：

```bash
curl http://your-domian/your-entrance/health
```

### 服务正常

```
HTTP/1.1 200 OK
Content-Type: text/html

ok
```

### 服务异常

```
HTTP/1.1 500 Internal Server Error
Content-Type: text/html

error
```

也可以通过命令行 `health:check` 进行健康检查。
默认不进行上报，如果需要上报可以使用 `--report` 选项 

```bash
php think health:check
```

### 服务正常

```
ok
```

### 服务异常

```
CheckEnv APP_DEBUG is not falsy
CheckCache health_check_cache_key is not set
```

## 文档和链接

[官网](https://153264.github.io/think-health/) ·  [更新策略](https://github.com/153264/think-health/security/policy)

## License

MIT