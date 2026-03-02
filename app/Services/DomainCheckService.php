<?php

namespace App\Services;

use App\Models\Domain;
use App\Models\DomainCheck;
use App\Notifications\DomainStatusChanged;
use Illuminate\Support\Facades\Http;
use Throwable;

class DomainCheckService
{
    public function check(Domain $domain): DomainCheck
    {
        $startTime = microtime(true);

        try {
            $response = Http::timeout($domain->timeout_seconds)
                ->send($domain->method, $domain->url);

            $responseTime = (int) ((microtime(true) - $startTime) * 1000);

            $check = $domain->checks()->create([
                'status' => $response->successful() ? 'UP' : 'DOWN',
                'http_code' => $response->status(),
                'response_time_ms' => $responseTime,
                'error_message' => null,
                'checked_at' => now(),
            ]);

        } catch (Throwable $e) {
            $responseTime = (int) ((microtime(true) - $startTime) * 1000);

            $check = $domain->checks()->create([
                'status' => 'DOWN',
                'http_code' => null,
                'response_time_ms' => $responseTime,
                'error_message' => $e->getMessage(),
                'checked_at' => now(),
            ]);
        }

        $domain->update(['last_checked_at' => now()]);

         if ($previousStatus !== null && $previousStatus !== $check->status) {
            $domain->user->notify(new DomainStatusChanged($domain, $check));
        }

        return $check;
    }
}