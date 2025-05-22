<?php

namespace App\Console\Commands;

use App\Models\order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarkFailedOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:mark-failed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark all pending orders older than 15 minutes as failed';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $expiredTime = Carbon::now()->subMinutes(15);

        $count = order::where('status', 'pending')
            ->where('created_at', '<=', $expiredTime)
            ->update(['status' => 'failed']);

        $this->info("$count orders marked as failed.");
    }
}
