<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class VisitStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Visitors (last 30 days)';
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        $today = now()->toDateString();
        $from = now()->subDays(29)->toDateString();

        $rolled = DB::table('daily_visit_stats')
            ->where('path', '')
            ->whereBetween('day', [$from, $today])
            ->where('day', '<', $today)
            ->selectRaw('sum(visits) v, sum(unique_visitors) u')
            ->first();

        $todayAgg = DB::table('visits')
            ->whereDate('occurred_at', $today)
            ->where('is_bot', false)
            ->selectRaw('count(*) v, count(distinct ip_hash) u')
            ->first();

        $visits = (int)($rolled->v ?? 0) + (int)($todayAgg->v ?? 0);
        $unique = (int)($rolled->u ?? 0) + (int)($todayAgg->u ?? 0);

        return [
            Stat::make('Visits (7d)', number_format($visits)),
            Stat::make('Unique Visitors (7d)', number_format($unique))
        ];
    }

    protected function getColumns(): int
    {
        return 2;
    }
}
