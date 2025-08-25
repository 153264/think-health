<?php

declare(strict_types=1);

namespace think\health;

use Throwable;

class CheckResult
{
    /**
     * @var array<string,true|Throwable>
     * @date 2025-08-21
     * @example
     * @author lpf
     * @since 1.0.0
     */
    private array $items = [];

    public function set(string $key, true|Throwable $value): void
    {
        $this->items[$key] = $value;
    }

    /**
     * @return array<string,true|Throwable>
     * @date 2025-08-21
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function isOk(): bool
    {
        return empty($this->getErrors());
    }

    /**
     * @return array<string,string>
     * @date 2025-08-21
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function getMessages(): array
    {
        return array_map(
            fn ($item) => $item instanceof Throwable ? $item->getMessage() : 'ok',
            $this->items
        );
    }

    /**
     * @return array<string,Throwable>
     * @date 2025-08-21
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function getErrors(): array
    {
        return array_filter(
            $this->items,
            fn ($item) => $item instanceof Throwable
        );
    }

    /**
     * @return array<string,string>
     * @date 2025-08-21
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function getErrorMessages(): array
    {
        return array_map(
            fn ($item) => $item->getMessage(),
            $this->getErrors()
        );
    }

    /**
     * @return array<string,true>
     * @date 2025-08-21
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function getSuccess(): array
    {
        return array_filter(
            $this->items,
            fn ($item) => $item === true
        );
    }
}
