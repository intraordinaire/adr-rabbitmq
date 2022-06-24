<?php

namespace App\Console\Commands;

use App\Jobs\ProcessOrder;
use Illuminate\Console\Command;

class OrderProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:process {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create order process jobs';

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
        $count = $this->argument('count');
        for($i = 0; $i < $count; $i++) {
            ProcessOrder::dispatch(['order_id' => $i])->onQueue('php-orders');
        }

        $this->info($count . ' ' . __CLASS__ .' job(s) launched');
    }
}
