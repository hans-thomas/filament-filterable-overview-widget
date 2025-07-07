<?php

namespace Hans\FilterableStatsOverviewWidget\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class FilterableStatsOverviewWidgetCommand extends Command
{
    public $signature = '
    make:filament-filterable-overview-widget
    {name : Name of the widget}
    {--p|panel=default : Select a panel}
    ';

    public $description = 'Create a Filterable stats overview widget class';

    public function handle(): int
    {
        $name = $this->argument('name');
        $panel = $this->option('panel');

        $path = app_path('Filament/Widgets');
        $namespace = 'App\\Filament\\Widgets';
        if ($panel !== 'default') {
            $panel = ucfirst($panel);
            $path = app_path("Filament/{$panel}/Widgets");
            $namespace = 'App\\Filament\\' . ucfirst($panel) . '\\Widgets';
        }
        $path .= '/' . ucfirst($name);

        $filesystem = app(Filesystem::class);

        $stub = $filesystem->get(__DIR__ . '/../../stubs/FilterableStatsOverviewWidget.stub');
        $stub = str_replace('{{NAMESPACE}}', $namespace, $stub);

        $filesystem->ensureDirectoryExists(
            pathinfo($path, PATHINFO_DIRNAME),
        );
        $filesystem->put("$path.php", $stub);

        return self::SUCCESS;
    }
}
