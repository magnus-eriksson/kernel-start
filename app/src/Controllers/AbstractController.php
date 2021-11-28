<?php

namespace App\Controllers;

use App\Services\Auth;
use Kernel\Abstracts\AbstractController as KernelAbstractController;

/**
 * @inheritDoc
 * @property Auth $auth
 */
abstract class AbstractController extends KernelAbstractController
{
}
