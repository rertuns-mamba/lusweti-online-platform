<?php

namespace App\Filament\Widgets;

use App\Models\Subscriber;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SubscriberCount extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Subscribers', Subscriber::count())
                ->description('Newsletter subscribers')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('success'),
        ];
    }
}
