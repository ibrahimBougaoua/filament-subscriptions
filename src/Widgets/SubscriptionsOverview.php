<?php

namespace IbrahimBougaoua\FilamentSubscription\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use IbrahimBougaoua\FilamentSubscription\Models\PlanSubscription;

class SubscriptionsOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getCards(): array
    {
        $profit_today = PlanSubscription::whereDate('created_at', Carbon::now()->today())->sum('price');

        $profit_today_data = Trend::model(PlanSubscription::class)
            ->between(
                start: now()->subDay(),
                end: now(),
            )
            ->perDay()
            ->count();

        $profit_today_arr = [];

        foreach ($profit_today_data->map(fn (TrendValue $value) => $value->aggregate) as $key => $item) {
            $profit_today_arr[] = $item;
        }

        $profit_last_week = PlanSubscription::whereDate('created_at', Carbon::now()->subDays(7))->sum('price');

        $profit_last_week_data = Trend::model(PlanSubscription::class)
            ->between(
                start: now()->subWeek(),
                end: now(),
            )
            ->perDay()
            ->count();

        $profit_last_week_arr = [];

        foreach ($profit_last_week_data->map(fn (TrendValue $value) => $value->aggregate) as $key => $item) {
            $profit_last_week_arr[] = $item;
        }

        $profit_last_month = PlanSubscription::whereDate('created_at', Carbon::now()->subMonth())->sum('price');

        $profit_last_month_data = Trend::model(PlanSubscription::class)
            ->between(
                start: now()->subMonth(),
                end: now(),
            )
            ->perDay()
            ->count();

        $profit_last_month_arr = [];

        foreach ($profit_last_month_data->map(fn (TrendValue $value) => $value->aggregate) as $key => $item) {
            $profit_last_month_arr[] = $item;
        }

        $profit_last_year = PlanSubscription::whereDate('created_at', Carbon::now()->subYear())->sum('price');

        $profit_last_year_data = Trend::model(PlanSubscription::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perDay()
            ->count();

        $profit_last_year_arr = [];

        foreach ($profit_last_year_data->map(fn (TrendValue $value) => $value->aggregate) as $key => $item) {
            $profit_last_year_arr[] = $item;
        }

        return [
            Card::make('Today', $profit_today.config('filament-subscriptions.currency'))
                ->description('Profit Today')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart($profit_today_arr)
                ->color('success'),
            Card::make('Last Week', $profit_last_week.config('filament-subscriptions.currency'))
                ->description('Profit Last Week')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart($profit_last_week_arr)
                ->color('success'),
            Card::make('Last Month', $profit_last_month.config('filament-subscriptions.currency'))
                ->description('Profit Last Month')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart($profit_last_month_arr)
                ->color('success'),
            Card::make('Last Year', $profit_last_year.config('filament-subscriptions.currency'))
                ->description('Profit Last Year')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart($profit_last_year_arr)
                ->color('success'),
        ];
    }
}
