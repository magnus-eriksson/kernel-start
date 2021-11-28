<?php

namespace App\Routes;

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use Kernel\Routing\Router;

class AppRoutes
{
    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->publicRoutes($router);
        $this->authentication($router);
    }


    /**
     * Public routes
     *
     * @param Router $router
     *
     * @return void
     */
    protected function publicRoutes(Router $router): void
    {
        $router->get('/', [HomeController::class, 'showHome'], [
            'name' => 'home',
        ]);
    }


    protected function authentication(Router $router): void
    {
        $router->get('/auth', [AuthController::class, 'showAuth'], [
            'name' => 'auth.show',
        ]);

        $router->post('/auth', [AuthController::class, 'authenticate'], [
            'name' => 'auth.do',
        ]);

        $router->get('/logout', [AuthController::class, 'logout'], [
            'name' => 'auth.logout',
        ]);
    }
}
