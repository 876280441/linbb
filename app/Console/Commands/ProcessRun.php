<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psy\Readline\Hoa\Console;
use Symfony\Component\Console\Command\Command as CommandAlias;
//use Illuminate\Support\Facades\Process;
class ProcessRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        phpinfo();
//        $result = Process::run();
//        return $result->output();

//        return CommandAlias::SUCCESS;
    }
}
