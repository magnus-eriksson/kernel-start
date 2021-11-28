<?php

namespace App\Repos;

use App\Entities\User;
use Kernel\Contracts\RepositoryInterface;

interface UsersInterface extends RepositoryInterface
{
    /**
     * Get a user by email
     *
     * @param string $email
     *
     * @return User|null
     */
    public function byEmail(string $email): ?User;
}
