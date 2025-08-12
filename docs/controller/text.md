---
outline: deep
---

# Text 文本控制器

```php
new \think\health\Controller\Text(
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
     * 正常信息
     * @var string
     */
    successMessage: 'ok',
    /**
     * 异常信息
     * @var string
     */
    errorMessage: 'error',
)
```

| 参数              | 类型    | 是否必传 | 默认值 | 说明       |
| ----------------- | ------- | -------- | ------ | ---------- |
| successStatusCode | integer | 否       | 200    | 正常状态码 |
| errorStatusCode   | integer | 否       | 500    | 异常状态码 |
| successMessage    | string  | 否       | ok     | 正常信息   |
| errorMessage      | string  | 否       | error  | 异常信息   |
