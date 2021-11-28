<?php

namespace App\Controllers;

use App\Entities\User;
use App\Repos\Pdo\Users;
use App\Repos\UsersInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends AbstractController
{
    /**
     * Show login form
     *
     * @return string
     */
    public function showAuth(): string
    {


        $errors = $this->session->getFlashBag()->get('errors');

        return $this->render('auth', [
            'error' => $errors ? $errors[0] : null,
        ]);
    }


    /**
     * Authenticate user
     *
     * @return RedirectResponse
     */
    public function authenticate(): RedirectResponse
    {
        $email = $this->request->request->get('email');
        $password = $this->request->request->get('password');

        $user = null;
        if (!empty($email) && !empty($password)) {
            $user = $this->auth->login($email, $password);
        }

        if ($user === null) {
            $this->session->getFlashBag()->add('errors', 'Invalid credentials');
            return $this->redirectToRoute('auth.show');
        }

        return $this->redirectToRoute('home');
    }

    /**
     * Log out the current user
     *
     * @return void
     */
    public function logout(): RedirectResponse
    {
        $this->auth->logout();

        return $this->redirectToRoute('home');
    }
}
