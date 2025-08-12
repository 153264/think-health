---
outline: deep
---

# CheckHttp 网络资源检查器

## 实例化

```php
new \think\health\Check\CheckHttp(
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
```

## 参数说明

| 参数        | 类型             | 是否必传 | 默认值               | 说明               |
| ----------- | ---------------- | -------- | -------------------- | ------------------ |
| url         | string           | 是       | -                    | 需要检查的网络资源 |
| timeout     | integer          | 否       | 30                   | 超时时间           |
| statusCodes | array\<integer\> | 否       | [200, 201, 202, 204] | 允许的 HTTP 状态码 |
