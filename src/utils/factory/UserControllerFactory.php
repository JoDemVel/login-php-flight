<?php

namespace App\Utils\Factory;

use App\Utils\Factory\ControllerFactory;
use App\Middlewares\JWT\UserAuthentication;
use App\Repositories\UserRepository;
use App\Services\Implement\UserServiceImplement;
use App\Web\Rest\UserContoller;

require_once 'src/web/rest/Controller.php';
require_once 'src/web/rest/UserController.php';
require_once 'src/utils/factory/ControllerFactory.php';
require_once 'src/middlewares/jwt/UserAuthentication.php';
require_once 'src/repositories/UserRepository.php';
require_once 'src/services/implement/UserServiceImplement.php';

class UserControllerFactory implements ControllerFactory {
    public function create() : UserContoller {
        $userAuthentication = new UserAuthentication(new UserServiceImplement(new UserRepository()));
        $userController = new UserContoller($userAuthentication);
        return $userController;
    }
}