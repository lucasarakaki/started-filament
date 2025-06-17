<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PatienttypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cats', Patient::where('type', 'cat')->count()),
            Stat::make('Birds', Patient::where('type', 'bird')->count()),
            Stat::make('Dogs', Patient::where('type', 'dog')->count()),
            Stat::make('Total Patients', Patient::count()),
        ];
    }
}
