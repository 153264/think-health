---
outline: deep
---

# CheckEnv 环境变量检查器

```php
new \think\health\Check\CheckEnv(
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
)
```

| 参数 | 类型                   | 是否必传 | 默认值 | 说明              |
| ---- | ---------------------- | -------- | ------ | ----------------- |
| keys | array\<string,string\> | 是       | -      | 需要检测的 key 值 |

| 类型   | 说明         |
| ------ | ------------ |
| falsy  | 为空或 0     |
| truthy | 为非空或非 0 |
| string | 为字符串     |
| int    | 为数字       |

> 其他类型值，直接比对字符串是否一致
