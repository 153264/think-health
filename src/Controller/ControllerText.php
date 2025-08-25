<?php

declare(strict_types=1);

namespace think\health\Controller;

use think\health\Contract\ControllerAbstracte;
use think\Response;

class ControllerText extends ControllerAbstracte
{
    public function __construct(
        private int $successStatusCode = 200,
        private int $errorStatusCode = 500,
        private string $successMessage = 'ok',
        private string $errorMessage = 'error',
    ) {
    }

    public function handle(): Response
    {
        $result = $this->check();
        $isOk = $result->isOk();
        return Response::create(
            $isOk ? $this->successMessage : $this->errorMessage,
            'html',
            $isOk ? $this->successStatusCode : $this->errorStatusCode
        );
    }
}
