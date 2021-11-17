<?php

use App\Controllers\HomeController;

/**
 * @var Maer\Router\Router $r
 */
$r = $kernel->router;

// Routes
// ------------------------------------------------
$r->get('/', [HomeController::class, 'showHome']);
