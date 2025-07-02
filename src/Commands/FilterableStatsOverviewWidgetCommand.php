<?php

namespace FilterableStatsWithFormOverview\FilterableStatsOverviewWidget\Commands;

use Illuminate\Console\Command;

class FilterableStatsOverviewWidgetCommand extends Command
{
    public $signature = 'filterablestatsoverviewwidget';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
