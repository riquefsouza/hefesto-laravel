<?php

namespace App\Base\Services;

use App\Admin\VO\UserVO;
use App\Admin\VO\AuthenticatedUserVO;

interface IModeTestService {

    /**
     * @return AuthenticatedUserVO|null
     */
    public function start(SystemService $systemService, UserVO $userVO,
        AuthenticatedUserVO $authenticatedUser, bool $usuarioLDAP): AuthenticatedUserVO|null;

    /**
     * @return AuthenticatedUserVO|null
     */
    public function mountAuthenticatedUser(SystemService $systemService, UserVO $user,
        AuthenticatedUserVO $authenticatedUser, bool $usuarioLDAP): AuthenticatedUserVO|null;
}
