<?php

declare(strict_types=1);

namespace think\health\Check;

use think\Exception;
use think\health\Contract\CheckAbstracte;

/**
 * 检查网络资源
 *
 * @date 2025-07-25
 * @example
 * @author lpf
 * @since 1.0.0
 */
class CheckHttp extends CheckAbstracte
{
    /**
     * Undocumented function
     *
     * @param string $url
     * @param integer $timeout
     * @param array<integer> $statusCodes
     * @date 2025-08-04
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function __construct(
        private string $url,
        private int $timeout = 30,
        private array $statusCodes = [200, 201, 202, 204],
    ) {
    }

    public function name(): string
    {
        return '检查网络资源 ' . $this->url;
    }

    public function handle(): void
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->url,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_CONNECTTIMEOUT => $this->timeout,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (!in_array($httpCode, $this->statusCodes)) {
            throw new Exception("HTTP request failed with status code: {$httpCode}", 1);
        }
        curl_close($curl);
    }
}
