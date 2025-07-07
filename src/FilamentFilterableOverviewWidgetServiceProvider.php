<?php

namespace Hans\FilamentFilterableOverviewWidget;

use Hans\FilamentFilterableOverviewWidget\Commands\FilamentFilterableOverviewWidgetCommand;
use Illuminate\Filesystem\Filesystem;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentFilterableOverviewWidgetServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filterableStatsOverviewWidget';

    public static string $viewNamespace = 'filterableStatsOverviewWidget';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->askToStarRepoOnGitHub('hans-thomas/filterableStatsOverviewWidget');
            });

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filterableStatsOverviewWidget/{$file->getFilename()}"),
                ], 'filterableStatsOverviewWidget-stubs');
            }
        }
    }

    protected function getAssetPackageName(): ?string
    {
        return 'hans-thomas/filterableStatsOverviewWidget';
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FilamentFilterableOverviewWidgetCommand::class,
        ];
    }
}
