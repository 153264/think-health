<?php

declare(strict_types=1);

namespace think\health\Check;

use think\Exception;
use think\health\Contract\CheckAbstracte;

/**
 * 检查文件夹大小
 *
 * @date 2025-07-25
 * @example
 * @author lpf
 * @since 1.0.0
 */
class CheckFolder extends CheckAbstracte
{
    /**
     * @param array<string,int> $folders 需要检查的文件夹 键为文件夹路径，值为允许的最大大小（字节）
     * @date 2025-08-04
     * @example
     * @author lpf
     * @since 1.0.0
     */
    public function __construct(
        private array $folders = [],
    ) {
    }

    public function name(): string
    {
        return 'CheckFolder';
    }

    public function handle(): void
    {
        $folders = $this->folders;
        foreach ($folders as $folder => $maxSize) {
            $size = $this->getFolderSize($folder);
            if ($size > $maxSize) {
                throw new Exception("The size of the folder {$folder} has exceeded the upper limit. The current size is {$size} bytes, and the maximum allowable size is {$maxSize} bytes");
            }
        }
    }

    private function getFolderSize(string $dir): int
    {
        $size = 0;
        if (!is_dir($dir)) {
            return 0;
        }
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($path)) {
                $size += $this->getFolderSize($path);
            } else {
                $size += filesize($path);
            }
        }
        return $size;
    }
}
