<?php

namespace App\Repos\Pdo;

use App\Entities\User;
use App\Repos\UsersInterface;
use Kernel\Abstracts\AbstractRepository;

class Users extends AbstractRepository implements UsersInterface
{
    /**
     * @inheritDoc
     */
    protected string $table = 'users';

    /**
     * @inheritDoc
     */
    protected string $entity = User::class;


    /**
     * @inheritDoc
     */
    public function byEmail(string $email): ?User
    {
        return $this->oneByColumnValue($email, 'email');
    }
}
