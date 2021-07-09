<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Base\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Messages;
use App\Admin\VO\UserVO;
use App\Base\Services\SystemService;

class LoginController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private SystemService $systemService;

    public function __construct(SystemService $systemService)
    {
        $this->systemService = $systemService;
    }

    private function params(Request $request, bool $bloginError): array
    {
        $messages = Messages::MESSAGES;

        $this->loadMessages($request);

        $alertMessage = $this->alertMessage;
        $menuItem = $this->menuItem;
        $userLogged = $this->userLogged;
        $loginError = $bloginError;

        return compact('messages', 'alertMessage',
            'menuItem', 'userLogged', 'loginError');
    }

    public function index(Request $request)
    {
        $params = $this->params($request, false);

        return view('login.index', $params);
    }

    public function login(Request $request)
    {
        $user = new UserVO();
        $user->Create($request->login, $request->password);

        if (strlen(trim($user->getLogin())) > 0 && strlen(trim($user->getPassword())) > 0)
        {
            if ($this->systemService->authenticate($user))
            {
                $authenticatedUser = $this->systemService->getAuthenticatedUser();
                $this->setUserAuthenticated($request, $authenticatedUser);
            }
            else
            {
                $params = $this->params($request, true);
                return view('login.index', $params);
            }
        }
        else
        {
            $params = $this->params($request, true);
            return view('login.index', $params);
        }

        //$params = $this->params($request, false);
        //return view('home.index', $params);
        return redirect()->route('showHome');
    }

    public function logout(Request $request)
    {
        $this->removeUserAuthenticated($request);

        return redirect()->route('showLogin');
    }

    public function accessDenied(Request $request)
    {
        $params = $this->params($request, false);
        return view('accessDenied.index', $params);
    }
}
