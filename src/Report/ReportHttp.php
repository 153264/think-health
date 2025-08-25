<?php

declare(strict_types=1);

namespace think\health\Report;

use think\Exception;
use think\health\CheckResult;
use think\health\Contract\ReportAbstracte;

class ReportHttp extends ReportAbstracte
{
    public function __construct(
        private string $url,
        private int $timeout = 30,
    ) {
    }

    /**
     * @return void
     * @date 2025-08-04
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function handle(CheckResult $result): void
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->url,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_CONNECTTIMEOUT => $this->timeout,
            CURLOPT_HEADER => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($result->getMessages()),
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        ]);
        curl_exec($curl);
        $error = curl_errno($curl);
        if ($error) {
            throw new Exception("post {$this->url} error: " . $error, 1);
        }
        curl_close($curl);
    }
}
