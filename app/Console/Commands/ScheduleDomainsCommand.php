<?php

namespace App\Console\Commands;

use App\Jobs\CheckDomainJob;
use App\Models\Domain;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ScheduleDomainsCommand extends Command
{
    protected $signature = 'domains:check';
    protected $description = 'Dispatch check jobs for domains that are due';

    public function handle(): void
    {
        $now = now();

        Domain::query()
            ->where('is_active', true)
            ->where(function ($query) use ($now) {
                $query->whereNull('last_checked_at')
                      ->orWhereRaw(
                          'DATE_ADD(last_checked_at, INTERVAL check_interval_minutes MINUTE) <= ?',
                          [$now]
                      );
            })
            ->each(fn (Domain $domain) => CheckDomainJob::dispatch($domain));

        $this->info('Done.');
    }
}