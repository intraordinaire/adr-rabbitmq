<?php

namespace App\Console\Commands;

use App\Jobs\ProcessOrder;
use App\Jobs\ProcessProductOrder;
use Illuminate\Console\Command;

class FullOrderProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:full {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create multiple processes jobs';

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
            for($j = 0; $j < rand(1, 5); $j++) {
                ProcessProductOrder::dispatch(['order_id' => $i, 'product_id' => uniqid()])->onQueue('product-orders');
            }
            ProcessOrder::dispatch(['order_id' => $i])->onQueue('orders');
        }

        $this->info($count . ' ' . __CLASS__ .' job(s) launched');
    }
}
