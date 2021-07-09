<?php

namespace App\Base\Services;

use App\Admin\VO\UserVO;
use App\Admin\VO\ModeTestVO;
use App\Admin\VO\AuthenticatedUserVO;
use App\Admin\Services\AdmParameterService;
use App\Admin\Services\AdmProfileService;
use App\Admin\Services\AdmUserService;
use Exception;

class ModeTestService implements IModeTestService
{

    const TEST_PASSWORD = "dfkdfsldkhf";

    private AdmParameterService $admParameterService;

    private AdmProfileService $profileService;

    private AdmUserService $userService;

    public function __construct(AdmParameterService $admParameterService,
        AdmProfileService $profileService, AdmUserService $userService)
    {
        $this->admParameterService = $admParameterService;
        $this->profileService = $profileService;
        $this->userService = $userService;
    }

    public function load(string $login): ModeTestVO
    {
        $modeTestVO = new ModeTestVO();
        $lista = $this->findAll();
        foreach ($lista as $item)
        {
            if($login === $item->getLogin()){
                $modeTestVO = $item;
                break;
            }
        }

        return $modeTestVO;
    }

    /**
     * @return ModeTestVO[]|null
     */
    public function findAll()
    {
        $lista = array();
        $valor = "";

        try
        {
            $valor = $this->admParameterService->getValueByCode("MODO_TESTE");
        }
        catch (Exception)
        {
            $valor = "";
        }

        if ($valor != null && strlen($valor) > 0)
        {
            $lista = json_decode($valor);
        }

        return $lista;
    }

    /**
     * @return AuthenticatedUserVO|null
     */
    public function start(SystemService $systemService, UserVO $userVO,
        AuthenticatedUserVO $authenticatedUser, bool $usuarioLDAP): AuthenticatedUserVO|null
    {
        $authenticatedUser->setModeTest(false);

        $lista = $this->findAll();

        $mtvo = new ModeTestVO();

        foreach ($lista as $vo)
        {
            if($vo->ativo &&
                $vo->login === $authenticatedUser->getUserName())
            {
                $mtvo = $vo;
                break;
            }
        }

        if ($mtvo != null){
            $authenticatedUser->setModeTest(true);
            $authenticatedUser->setModeTestLogin($authenticatedUser->getUserName());

            $svirtual = $mtvo->getLoginVirtual();

            if (strlen($svirtual) > 0) {
                return $this->mountAuthenticatedUser($systemService, $userVO,
                    $authenticatedUser, $usuarioLDAP);
            }
        }

        return $authenticatedUser;
    }

    /**
     * @return AuthenticatedUserVO|null
     */
    public function mountAuthenticatedUser(SystemService $systemService, UserVO $user,
        AuthenticatedUserVO $authenticatedUser, bool $usuarioLDAP): AuthenticatedUserVO|null
    {
        $authenticatedUser->setUserName($user->getLogin());
        $authenticatedUser->setDisplayName($user->getName());
        $authenticatedUser->setEmail($user->getEmail());
        $authenticatedUser->setListPermission($this->profileService->getPermission($authenticatedUser));

        if (count($authenticatedUser->getListPermission()) > 0)
        {

            $listaIdPerfis = array();
            foreach ($authenticatedUser->getListPermission() as $permissao)
            {
                array_push($listaIdPerfis, $permissao->getProfile()->getId());
            }

            $authenticatedUser->setListMenus($systemService->findMenuParentByProfile($listaIdPerfis));

            $authenticatedUser->setListAdminMenus($systemService->findAdminMenuParentByProfile($listaIdPerfis));
        }
        else
        {
            //throw new Exception("Usuário sem perfil associado!");
            return null;
        }

        if ($authenticatedUser->getModeTest())
        {
            $authenticatedUser->setModeTestLoginVirtual($user->getLogin());
        }

        return $authenticatedUser;
    }

    public function enableTestPassword(): bool
    {
        $habilitar = false;
        $valor = "";
        try
        {
            $valor = $this->admParameterService->getValueByCode("HABILITAR_SENHA_TESTE");
            $habilitar = boolval($valor);
        }
        catch (Exception)
        {
            $habilitar = false;
        }

        return $habilitar;
    }

    public function SHA512(string $input): string
    {
        return hash("sha512", $input, false);
    }

    public function autenticarViaSenhaTeste(string $login, string $password): UserVO
    {
        $userVO = new UserVO();
        if (strlen($login) > 0 && strlen($password) > 0)
        {
            $csenha = $this->SHA512($this->TEST_PASSWORD);

            if ($password === $csenha)
            {
                $userVO = $this->userService->findByLikeEmail($login);
                $userVO = $userVO[0];
            }
        }
        return $userVO;
    }
}
