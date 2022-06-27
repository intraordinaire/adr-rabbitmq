<?php

namespace App\Console\Commands;

use App\Jobs\ProcessProduct;
use Illuminate\Console\Command;

class ProductProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:process {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create product process jobs';

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
            ProcessProduct::dispatch(['product_id' => $i])->onQueue('products');
        }

        $this->info($count . ' ' . __CLASS__ .' job(s) launched');
    }
}
