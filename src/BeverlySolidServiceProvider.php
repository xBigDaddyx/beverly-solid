<?php

namespace Xbigdaddyx\BeverlySolid;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Xbigdaddyx\BeverlySolid\Commands\BeverlySolidCommand;
use Xbigdaddyx\BeverlySolid\Filament\Pages\SolidPolybagsRelationManager;
use Xbigdaddyx\BeverlySolid\Livewire\ListSolidPolybag;
use Xbigdaddyx\BeverlySolid\Testing\TestsBeverlySolid;

class BeverlySolidServiceProvider extends PackageServiceProvider
{
    public static string $name = 'beverly-solid';

    public static string $viewNamespace = 'beverly-solid';

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
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('xbigdaddyx/beverly-solid');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
        $this->app->bind('BeverlySolid', \Xbigdaddyx\BeverlySolid\BeverlySolid::class);
    }

    public function packageBooted(): void
    {
        if (class_exists(Livewire::class)) {
            Livewire::component('solid-polybags-relation-manager', SolidPolybagsRelationManager::class);
            Livewire::component('list-solid-polybag', ListSolidPolybag::class);
        }
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        // if (app()->runningInConsole()) {
        //     foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
        //         $this->publishes([
        //             $file->getRealPath() => base_path("stubs/beverly-solid/{$file->getFilename()}"),
        //         ], 'beverly-solid-stubs');
        //     }
        // }

        // Testing
        //Testable::mixin(new TestsBeverlySolid());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'xbigdaddyx/beverly-solid';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('beverly-solid', __DIR__ . '/../resources/dist/components/beverly-solid.js'),
            //Css::make('beverly-solid-styles', __DIR__ . '/../resources/dist/beverly-solid.css'),
            //Js::make('beverly-solid-scripts', __DIR__ . '/../resources/dist/beverly-solid.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            //BeverlySolidCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            '2024_09_23_145301_create_beverly_solid_polybags_table'
        ];
    }
}
