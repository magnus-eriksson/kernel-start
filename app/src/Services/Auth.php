<?php

namespace App\Services;

use App\Entities\User;
use App\Repos\UsersInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class Auth
{
    /**
     * @var UsersInterface
     */
    protected UsersInterface $users;

    /**
     * @var Session
     */
    protected Session $session;

    /**
     * Current logged in user
     *
     * @var User|null
     */
    protected User|null $currentUser;

    /**
     * The session key to store the logged in user id
     *
     * @var string
     */
    protected string $sessionKey = 'kernel/user/id';


    /**
     * @param UsersInterface $users

     */
    public function __construct(UsersInterface $users, Session $session)
    {
        $this->users = $users;
        $this->session = $session;

        // Get the user if we have a valid session
        $userId = $session->get($this->sessionKey);
        $this->currentUser = $userId ? $users->byId($userId) : null;
    }


    /**
     * Authenticate email/password
     *
     * @param string $email
     * @param string $password
     *
     * @return User|null
     */
    public function authenticate(string $email, string $password): ?User
    {
        $user = $this->users->byEmail($email);

        if ($user === null) {
            return null;
        }

        return $this->passwordVerify($password, $user->password)
            ? $user
            : null;
    }


    /**
     * Log a user in
     *
     * @param string $email
     * @param string $password
     *
     * @return User|null
     */
    public function login(string $email, string $password): ?User
    {
        $user = $this->authenticate($email, $password);

        if ($user) {
            $this->setUser($user);
        }

        return $user;
    }


    /**
     * Set the current logged in user
     *
     * @param User $user
     *
     * @return void
     */
    public function setUser(User $user): void
    {
        $this->session->set($this->sessionKey, $user->id);
        $this->currentUser = $user;
    }


    /**
     * Get the current logged in user
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->currentUser;
    }


    /**
     * Check if we have a current user
     *
     * @return bool
     */
    public function hasUser(): bool
    {
        return !empty($this->currentUser);
    }


    /**
     * Unset the current user and the session
     *
     * @return void
     */
    public function logout(): void
    {
        $this->currentUser = null;
        $this->session->clear();
    }


    /**
     * Hash a password
     *
     * @param string $password
     *
     * @return string
     */
    public function passwordHash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, [
            'cost' => 12,
        ]);
    }


    /**
     * Verify a password
     *
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function passwordVerify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
