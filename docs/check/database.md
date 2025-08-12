---
outline: deep
---

# CheckDataBase 数据库检查器

## 实例化

```php
new \think\health\Check\CheckDataBase(
    /**
     * 需要检测的数据库连接
     * 如果为空，则检测所有数据库连接
     * @var array<string>
     */
    connections: []
)
```

## 参数说明

| 参数        | 类型            | 是否必传 | 默认值 | 说明                                                    |
| ----------- | --------------- | -------- | ------ | ------------------------------------------------------- |
| connections | array\<string\> | 否       | []     | 需要检测的数据库连接<br/>如果为空，则检测所有数据库连接 |
