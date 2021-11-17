<?php

use Kernel\Kernel;
use Maer\Router\Router;

require __DIR__ . '/vendor/autoload.php';

$kernel = new Kernel([
    __DIR__ . '/app/config/config.php',
    __DIR__ . '/app/config/dev.php',
    __DIR__ . '/app/config/prod.php'
]);

$kernel->paths->set('app', __DIR__ . '/app');
$kernel->paths->set('public', __DIR__ . '/public');

// Load routes
require $kernel->paths('app') . '/routes.php';

return $kernel;
