<?php

namespace IbrahimBougaoua\SubscriptionSystem\Commands;

use Illuminate\Console\Command;

class SubscriptionSystemCommand extends Command
{
    public $signature = 'filament-subscriptions';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
