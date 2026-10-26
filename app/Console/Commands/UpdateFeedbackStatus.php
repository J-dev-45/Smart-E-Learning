<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateFeedbackStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-feedback-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark new feedback as unread after 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $updated = DB::table('feedback')
            ->where('status', 'New')
            ->where('created_at', '<=', now()->subHours(24))
            ->update(['status' => 'Unread']);

        $this->info("Updated {$updated} feedback record(s).");

        return self::SUCCESS;
    }
}