---
outline: deep
---

# 自定义上报器

必须要继承 `think\health\Contract\ReportAbstracte` 类

```php
<?php
declare(strict_types=1);

namespace app\report;

use think\health\Contract\ReportAbstracte;

class ReportApp extends ReportAbstracte
{
    /**
     * @param Collection<string,Throwable|bool> $messages
     */
    public function handle(Collection $messages): void {
        // report logic
    }
}
```

编写好自定义的上报器后，需要在配置文件中的 `reportHandles` 添加您的上报器

```php
[
    'reportHandles' => [
        // ... 其他上报
        new \app\report\ReportApp()
    ],
]
```
