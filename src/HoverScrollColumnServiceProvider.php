<?php

declare(strict_types = 1);

namespace Wagnerbugs\FilamentHoverScrollColumn;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HoverScrollColumnServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * The ->name() value becomes the prefix for publishing
         * (views, config, etc.). ->hasViews('hover-scroll-column')
         * registers this package's resources/views directory under
         * the "hover-scroll-column::" namespace, so the Blade file
         * resources/views/hover-scroll-column.blade.php is referenced
         * as "hover-scroll-column::hover-scroll-column".
         */
        $package
            ->name('filament-hover-scroll-column')
            ->hasViews('hover-scroll-column');
    }
}
