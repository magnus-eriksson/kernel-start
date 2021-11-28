<?php

namespace App\Entities;

class User extends AbstractEntity
{
    protected $id = 0;
    protected $email = '';
    protected $password = '';
    protected $reset = '';

    protected function protect(): array
    {
        return [
            'password',
            'reset',
        ];
    }
}
