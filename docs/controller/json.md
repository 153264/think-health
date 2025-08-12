---
outline: deep
---

# Text 文本控制器

```php
new \think\health\Controller\Json(
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

| 参数              | 类型    | 是否必传 | 默认值 | 说明             |
| ----------------- | ------- | -------- | ------ | ---------------- |
| successStatusCode | integer | 否       | 200    | 正常状态码       |
| errorStatusCode   | integer | 否       | 500    | 异常状态码       |
| showErrorMessage  | boolean | 否       | false  | 是否显示异常信息 |
