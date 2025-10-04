<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class VisitsTrendChart extends ChartWidget
{
    protected static ?string $heading = 'Visits (last 30 days)';

    protected int|string|array $columnSpan = [
        'sm' => 1,
        'lg' => 2,
    ];

    protected function getData(): array
    {
        $today = now()->toDateString();
        $from = now()->subDays(29)->toDateString();

        $rolled = DB::table('daily_visit_stats')
            ->where('path', '')
            ->whereBetween('day', [$from, $today])
            ->where('day', '<', $today)
            ->orderBy('day')
            ->get(['day', 'visits', 'unique_visitors']);

        $todayRow = DB::table('visits')
            ->whereDate('occurred_at', $today)
            ->where('is_bot', false)
            ->selectRaw('? as day, count(*) as visits, count(distinct ip_hash) as unique_visitors', [$today])
            ->first();

        $byDay = collect();

        for ($d = 0; $d < 30; $d++) {
            $date = now()->subDays(29 - $d)->toDateString();
            $byDay[$date] = ['day' => $date, 'visits' => 0, 'unique_visitors' => 0];
        }
        foreach ($rolled as $r) {
            $byDay[$r->day] = ['day' => $r->day, 'visits' => (int)$r->visits, 'unique_visitors' => (int)$r->unique_visitors];
        }
        if ($todayRow) {
            $byDay[$today] = ['day' => $today, 'visits' => (int)$todayRow->visits, 'unique_visitors' => (int)$todayRow->unique_visitors];
        }

        $labels = array_column($byDay->values()->all(), 'day');
        $visits = array_column($byDay->values()->all(), 'visits');
        $uniqs  = array_column($byDay->values()->all(), 'unique_visitors');

        return [
            'labels' => $labels,
            'datasets' => [
                ['label' => 'Visits', 'borderColor' => '#3b82f6', 'data' => $visits],
                ['label' => 'Uniques', 'borderColor' => '#f43f5e', 'data' => $uniqs],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
