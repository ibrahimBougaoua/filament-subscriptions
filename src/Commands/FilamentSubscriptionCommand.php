<?php

namespace IbrahimBougaoua\FilamentSubscription\Commands;

use Illuminate\Console\Command;

class FilamentSubscriptionCommand extends Command
{
    public $signature = 'filament-subscriptions';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
