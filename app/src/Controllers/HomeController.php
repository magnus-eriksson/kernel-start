<?php

namespace App\Controllers;

use Kernel\Abstracts\AbstractController;

class HomeController extends AbstractController
{
    public function showHome()
    {
        return $this->render('home', [
            'user' => $this->auth->getUser(),
        ]);
    }
}
