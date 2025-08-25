<?php

declare(strict_types=1);

namespace think\health\Command;

use think\console\Command;
use think\console\input\Option;
use think\console\Table;
use think\health\Checker;
use think\health\CheckResult;
use think\health\Reporter;

class Check extends Command
{
    public function configure(): void
    {
        $this->setName('health:check')
            ->addOption('report', 'r', Option::VALUE_NONE, 'Report health')
            ->addOption('error', 'e', Option::VALUE_NONE, 'Error only')
            ->addOption('format', 'f', Option::VALUE_OPTIONAL, 'Format output [simple,table,line]', 'table')
            ->setDescription('Check health');
    }

    public function handle(): void
    {
        $input = $this->input;
        $output = $this->output;
        $checker = Checker::loadConfig();
        $result = $checker->check();
        if ($input->hasOption('report')) {
            $this->report($result);
            return;
        }
        /**
         * @var string $format
         */
        $format = $input->getOption('format');
        $messages = $input->hasOption('error') ? $result->getErrorMessages() : $result->getMessages();
        switch ($input->getOption('format')) {
            case 'simple':
                $output->writeln($result->isOk() ? 'ok' : 'error');
                break;
            case 'line':
                $this->lineRender($messages);
                break;
            case 'table':
                $this->tableRender($messages);
                break;
            default:
                throw new \InvalidArgumentException('Invalid format: ' . $format);
        }
    }

    /**
     * @param array<string, string> $messages
     * @return void
     * @date 2025-08-25
     * @example
     * @author lpf
     * @since 1.0.0
     */
    private function lineRender(array $messages): void
    {
        foreach ($messages as $name => $message) {
            $this->output->writeln($name . ' ' . $message);
        }
    }

    /**
     * @param array<string, string> $messages
     * @return void
     * @date 2025-08-25
     * @example
     * @author lpf
     * @since 1.0.0
     */
    private function tableRender(array $messages): void
    {
        $table = new Table();
        $table->setHeader(['Name', 'Message']);
        $rows = [];
        foreach ($messages as $name => $message) {
            $rows[] = [$name, $message];
        }
        $table->setRows($rows);
        $this->table($table);
    }

    private function report(CheckResult $result): void
    {
        $reporter = Reporter::loadConfig();
        $reporter->report($result);
    }
}
