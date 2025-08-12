<?php

declare(strict_types=1);

namespace think\health\Contract;

use think\Response;

abstract class ControllerAbstracte
{
    abstract public function handle(): Response;
}
