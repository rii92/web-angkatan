<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DispatchSyncJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:dispatch-sync {job} {parameter?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch Job';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $prefix = '\\App\Jobs\\';

        $className = trim($this->argument('job'));

        if (stripos($className, "/")) $className = str_replace('/', '\\', $className);

        $class = $prefix . $className;

        if (!class_exists($class)) return $this->error("{$class} class Not exists");

        $job = $this->argument('parameter') ? new $class($this->argument('parameter')) : new $class();

        dispatch_sync($job);

        return $this->info("Successfully Dispatch {$class} ");
    }
}
