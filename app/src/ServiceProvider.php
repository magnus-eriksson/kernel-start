<?php

namespace App;

use App\Repos\Pdo\Users;
use App\Repos\UsersInterface;
use App\Services\Auth;
use Illuminate\Container\Container;

class ServiceProvider
{
    /**
     * @var Container
     */
    protected Container $ioc;


    /**
     * @param Container $ioc
     */
    public function __construct(Container $ioc)
    {
        $this->ioc = $ioc;

        $this->services();
        $this->repos();
    }


    /**
     * Register services
     *
     * @return void
     */
    protected function services(): void
    {
        // Authentication
        $this->ioc->singleton(Auth::class, function ($ioc) {
            return new Auth(
                $ioc->make(UsersInterface::class),
                $ioc->session
            );
        });
        $this->ioc->alias(Auth::class, 'auth');
    }


    /**
     * Register repositories
     *
     * @return void
     */
    protected function repos(): void
    {
        // Users
        $this->ioc->singleton(UsersInterface::class, function ($ioc) {
            return new Users($ioc->db);
        });
    }
}
