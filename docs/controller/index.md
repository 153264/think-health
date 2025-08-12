---
outline: deep
---

# 自定义控制器

必须要继承 `think\health\Contract\ReportAbstracte` 类

```php
<?php
declare(strict_types=1);

namespace app\controller;

use think\Response;
use think\health\Contract\ControllerAbstracte;

class ControllerApp extends ControllerAbstracte
{
    public function handle(): Response {
        // controller logic
    }
}
```

编写好自定义的控制器后，需要在配置文件中的 `registerRoute.controller` 添加您的控制器

```php
[
    'registerRoute' => [
        // ... 其他配置
        'controller' => new \app\controller\ControllerApp()
    ],
]
```
