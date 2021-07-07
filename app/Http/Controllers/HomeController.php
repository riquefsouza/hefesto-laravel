<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Base\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Messages;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function params(Request $request): array
    {
        $messages = Messages::MESSAGES;

        $this->loadMessages($request);

        $alertMessage = $this->alertMessage;
        $menuItem = $this->menuItem;
        $userLogged = $this->userLogged;

        return compact('messages', 'alertMessage', 'menuItem', 'userLogged');
    }

    public function index(Request $request)
    {
        $authenticatedUser = $this->getAuthenticatedUser($request);

        $params = $this->params($request);

        if ($authenticatedUser != null)
        {
            return view('home.index', $params);
        }
        else
        {
            return view('login.login', $params);
        }
    }

}
