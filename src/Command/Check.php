<?php

declare(strict_types=1);

namespace think\health\Command;

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use think\facade\Config;
use think\health\CheckHealth;
use think\health\Contract\CheckAbstracte;
use think\health\Contract\ReportAbstracte;

class Check extends Command
{
    public function configure(): void
    {
        $this->setName('health:check')
            ->addOption('report', 'r', Option::VALUE_NONE, 'Report health')
            ->setDescription('Check health');
    }

    public function handle(Input $input, Output $output): void
    {
        /**
         * @var array<CheckAbstracte> $checkHandles
         */
        $checkHandles = Config::get('health.checkHandles');
        /**
         * @var array<ReportAbstracte> $reportHandles
         */
        $reportHandles = Config::get('health.reportHandles');
        $checkHealth = new CheckHealth(
            $checkHandles,
            $reportHandles
        );
        $checkHealth->check();
        if ($input->hasOption('report')) {
            $checkHealth->report();
        } else {
            $errors = $checkHealth->getErrors();
            if ($errors->isEmpty()) {
                $output->writeln('ok');
            } else {
                foreach ($errors as $name => $th) {
                    $output->writeln($name . ' ' . $th->getMessage());
                }
            }
        }
    }
}
