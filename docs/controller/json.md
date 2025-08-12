---
outline: deep
---

# ControllerJson JSON控制器

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

## 实例化

```php
new \think\health\Controller\ControllerJson(
    /**
     * 正常状态码
     * @var int
     */
    successStatusCode: 200,
    /**
     * 异常状态码
     * @var int
     */
    errorStatusCode: 500,
    /**
     * 是否显示异常信息
     * @var bool
     */
    showErrorMessage: false,
)
```

## 参数说明

| 参数              | 类型    | 是否必传 | 默认值 | 说明             |
| ----------------- | ------- | -------- | ------ | ---------------- |
| successStatusCode | integer | 否       | 200    | 正常状态码       |
| errorStatusCode   | integer | 否       | 500    | 异常状态码       |
| showErrorMessage  | boolean | 否       | false  | 是否显示异常信息 |

## 请求示例

```bash
curl http://your-domian/your-entrance/health

# 服务正常
HTTP/1.1 200 OK
Content-Type: text/html

{"CheckDataBase":"ok","CheckEnv":"ok",...}

# 服务异常
HTTP/1.1 500 Internal Server Error
Content-Type: text/html

{"CheckDataBase":"error","CheckEnv":"error",...}
```
