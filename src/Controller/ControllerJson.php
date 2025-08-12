<?php

declare(strict_types=1);

namespace think\health\Controller;

use think\App;
use think\health\CheckHealth;
use think\health\Contract\ControllerAbstracte;
use think\Response;
use Throwable;

class ControllerJson extends ControllerAbstracte
{
    public function __construct(
        private int $successStatusCode = 200,
        private int $errorStatusCode = 500,
        private bool $showErrorMessage = false,
    ) {
    }

    public function handle(): Response
    {
        $showErrorMessage = $this->showErrorMessage;
        $checkHealth = CheckHealth::loadConfig();
        $checkHealth->check();
        $isOk = $checkHealth->getErrors()->isEmpty();
        $messages = $checkHealth->getMessages()->map(
            static function (true|Throwable $message) use ($showErrorMessage): string {
                if ($message === true) {
                    return 'ok';
                }
                if ($showErrorMessage) {
                    return $message->getMessage();
                }
                /**
                 * @var App $app
                 */
                $app = app();
                if (!$app->isDebug()) {
                    return 'error';
                }
                return $message->getMessage();
            }
        );
        return Response::create(
            $messages->toArray(),
            'json',
            $isOk ? $this->successStatusCode : $this->errorStatusCode
        );
    }
}
