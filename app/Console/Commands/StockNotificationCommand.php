<?php

namespace App\Console\Commands;

use App\Product;

use Illuminate\Console\Command;

class StockNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // Retrieve all products that have a stock value of zero
        $outOfStockProducts = Product::where('stock', 0)->get();
        // Loop through each out of stock product and create a new out of stock product in the out_of_stock_products table
        foreach ($outOfStockProducts as $product) {
            $product->outOfStock()->create();
        }
    
        // Output a success message to the console
        $this->info('Out of stock products have been added to the out_of_stock_products table.');
    }
    
}
