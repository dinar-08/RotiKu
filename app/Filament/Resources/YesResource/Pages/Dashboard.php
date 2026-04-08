<?php

namespace App\Filament\Resources\YesResource\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';

    // opsional, ubah judulnya
    protected static ?string $title = 'Dashboard';
}
