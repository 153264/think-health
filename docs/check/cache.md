---
outline: deep
---

# CheckCache 缓存检查器

```php
new \think\health\Check\CheckCache(
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
)
```

| 参数   | 类型            | 是否必传 | 默认值                   | 说明                                        |
| ------ | --------------- | -------- | ------------------------ | ------------------------------------------- |
| stores | array\<string\> | 否       | []                       | 需要检测的缓存<br/>如果为空，则检测所有缓存 |
| key    | string          | 否       | health_check_cache_key   | 缓存 key                                    |
| value  | string          | 否       | health_check_cache_value | 缓存 value                                  |
