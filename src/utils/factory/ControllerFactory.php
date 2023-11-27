<?php

namespace App\Utils\Factory;

use App\Web\Rest\Controller;

require_once 'src/web/rest/Controller.php';

interface ControllerFactory {
    public function create() : Controller;
}