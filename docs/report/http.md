---
outline: deep
---

# ReportHttp 网络上报器

:::warning
暂时不对上报结果进行验证，或进行重试<br/>
建议使用 [GuzzleHttp](https://docs.guzzlephp.org/en/stable/)
:::

```php
new \think\health\Report\ReportHttp(
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
```

| 参数    | 类型    | 是否必传 | 默认值 | 说明     |
| ------- | ------- | -------- | ------ | -------- |
| url     | string  | 是       | -      | 上报地址 |
| timeout | integer | 否       | 30     | 超时时间 |
