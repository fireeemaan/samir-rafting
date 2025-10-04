<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class StoreVisit implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $payload)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::table('visits')->insert([
            'occurred_at'  => $this->payload['occurred_at'],
            'user_id'      => $this->payload['user_id'],
            'session_id'   => $this->payload['session_id'],
            'ip_hash'      => $this->payload['ip_hash'],
            'path'         => $this->payload['path'],
            'method'       => $this->payload['method'],
            'referer'      => $this->payload['referer'],
            'utm_source'   => $this->payload['utm_source'],
            'utm_medium'   => $this->payload['utm_medium'],
            'utm_campaign' => $this->payload['utm_campaign'],
            'is_bot'       => $this->payload['is_bot'],
            'ua'           => $this->payload['ua'],
        ]);
    }
}
