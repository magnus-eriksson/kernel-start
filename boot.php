<?php

use App\Routes\AppRoutes;
use App\ServiceProvider;
use Kernel\Kernel;

require __DIR__ . '/vendor/autoload.php';

// Instantiate the kernel
$kernel = new Kernel([
    __DIR__ . '/app/config/config.php',
    __DIR__ . '/app/config/ensure.php',
    __DIR__ . '/app/config/dev.php',
    __DIR__ . '/app/config/prod.php',
]);

// Set paths
$kernel->paths->set('app', __DIR__ . '/app');
$kernel->paths->set('public', __DIR__ . '/public');

// Register app specific services
new ServiceProvider($kernel->ioc);

// Load routes
new AppRoutes($kernel->router);

// Return the configured kernel instance
return $kernel;
