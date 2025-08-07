---
outline: deep
---

# 自定义检查器

必须要继承 `think\health\Contract\CheckAbstracte` 类

```php
<?php
declare(strict_types=1);

namespace app\check;

use think\health\Contract\CheckAbstracte;

class CheckApp extends CheckAbstracte
{
    public function name():string{
        return 'app check';
    }

    public function handle():void
    {
        // check logic
    }
}
```

编写好自定义的检查器后，需要在配置文件中的 `checkHandles` 添加您的检查器

```php
[
    'checkHandles' => [
        // ... 其他检查
        new \app\check\CheckApp()
    ],
]
```
