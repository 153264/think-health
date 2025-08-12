<?php

declare(strict_types=1);

namespace think\health\Command;

use think\console\Command;
use think\console\input\Option;
use think\health\CheckHealth;

class Check extends Command
{
    public function configure(): void
    {
        $this->setName('health:check')
            ->addOption('report', 'r', Option::VALUE_NONE, 'Report health')
            ->setDescription('Check health');
    }

    public function handle(): void
    {
        $input = $this->input;
        $output = $this->output;
        $checkHealth = CheckHealth::loadConfig();
        $checkHealth->check();
        if ($input->hasOption('report')) {
            $checkHealth->report();
        } else {
            $errors = $checkHealth->getErrorMessages();
            if ($errors->isEmpty()) {
                $output->writeln('ok');
            } else {
                foreach ($errors as $name => $error) {
                    $output->writeln($name . ' ' . $error);
                }
            }
        }
    }
}
