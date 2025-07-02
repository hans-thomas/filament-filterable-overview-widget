<?php

namespace FilterableStatsWithFormOverview\FilterableStatsOverviewWidget\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FilterableStatsWithFormOverview\FilterableStatsOverviewWidget\FilterableStatsOverviewWidget
 */
class FilterableStatsOverviewWidget extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \FilterableStatsWithFormOverview\FilterableStatsOverviewWidget\FilterableStatsOverviewWidget::class;
    }
}
