<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RollupVisits extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visits:rollup {--date=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggregate visits into daily_visit_stats';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $day = $this->option('date') ?: now()->subDay()->toDateString();

        // Site-wide
        $siteStats = DB::table('visits')
            ->selectRaw('date(occurred_at) as day,
                         count(*) as visits,
                         count(distinct ip_hash) as unique_visitors,
                         count(distinct user_id) as signed_in_users')
            ->whereDate('occurred_at', $day)
            ->where('is_bot', false)
            ->groupBy('day')
            ->first();

        if ($siteStats) {
            DB::table('daily_visit_stats')->updateOrInsert(
                ['day' => $day, 'path' => ''],
                [
                    'visits'           => $siteStats->visits,
                    'unique_visitors'  => $siteStats->unique_visitors,
                    'signed_in_users'  => $siteStats->signed_in_users,
                ]
            );
        }

        // Per-path
        $pathStats = DB::table('visits')
            ->selectRaw('date(occurred_at) as day, path,
                         count(*) as visits,
                         count(distinct ip_hash) as unique_visitors,
                         count(distinct user_id) as signed_in_users')
            ->whereDate('occurred_at', $day)
            ->where('is_bot', false)
            ->groupBy('day', 'path')
            ->get();

        foreach ($pathStats as $row) {
            DB::table('daily_visit_stats')->updateOrInsert(
                ['day' => $row->day, 'path' => $row->path],
                [
                    'visits'           => $row->visits,
                    'unique_visitors'  => $row->unique_visitors,
                    'signed_in_users'  => $row->signed_in_users,
                ]
            );
        }

        DB::table('visits')->where('occurred_at', '<', now()->subDays(90))->delete();

        $this->info("Rolled up stats for {$day}.");
        return self::SUCCESS;
    }
}
