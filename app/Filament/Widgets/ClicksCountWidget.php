<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ClicksCountWidget extends BaseWidget
{
    protected ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Page Views', PageView::count())
                ->description('Total page views')
                ->descriptionIcon('heroicon-o-arrow-top-right-on-square')
                ->color('success'),
        ];
    }
}
