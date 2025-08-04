<?php

declare(strict_types=1);

namespace think\health;

use think\Collection;
use think\health\Contract\CheckAbstracte;
use think\health\Contract\ReportAbstracte;
use Throwable;

class CheckHealth
{
    /**
     * @var Collection<string,Throwable|bool>
     */
    private Collection $messages;

    /**
     * @param array<CheckAbstracte> $checkHandles
     * @param array<ReportAbstracte> $reportHandles
     */
    public function __construct(
        private array $checkHandles,
        private array $reportHandles = [],
    ) {
        $this->messages = new Collection();
    }

    /**
     * @return Collection<string,Throwable|bool>
     * @date 2025-08-04
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    /**
     * @return Collection<string,Throwable>
     * @date 2025-08-04
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function getErrors(): Collection
    {
        /**
         * @var Collection<string,Throwable> $errors
         */
        $errors = $this->messages->filter(fn ($message) => $message instanceof Throwable);
        return $errors;
    }

    public function check(): void
    {
        foreach ($this->checkHandles as $checkHandle) {
            $name = $checkHandle->name();
            try {
                $checkHandle->handle();
                $this->messages[$name] = true;
            } catch (Throwable $th) {
                $this->messages[$name] = $th;
            }
        }
    }

    public function report(): void
    {
        foreach ($this->reportHandles as $reportHandle) {
            $reportHandle->handle($this->messages);
        }
    }
}
