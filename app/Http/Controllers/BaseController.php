<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use App\Base\Models\AlertMessageVO;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private Request $request;

    protected $alertMessage;

    protected $userLogged;

    protected $menuItem;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function LoadMessages(): void
    {
        $this->LoadMessages(null);
    }

    protected function LoadMessagesWithAlertMessage(AlertMessageVO $alertMessage): void
    {
        if ($alertMessage == null)
            $this->alertMessage = new AlertMessageVO();
        else
            $this->alertMessage = $alertMessage;

        $authenticatedUser = $this->GetAuthenticatedUser();

        if ($authenticatedUser!=null)
        {
            $authenticatedUser->User->Active = true;
            $this->userLogged = $authenticatedUser->User;

            $listMenus = $authenticatedUser->ListAdminMenus();

            $this->menuItem = $listMenus;
        } else
        {
            $this->userLogged = new UserVO();
            $this->userLogged->Active = false;

            $this->menuItem = array();
        }

    }

    public function GetAuthenticatedUser()
    {
        //AuthenticatedUserVO
        //if ($request->session()->has('authenticatedUser')) {
        return $this->request->session()->get('authenticatedUser');
    }

    public function SetUserAuthenticated(AuthenticatedUserVO $usu): void
    {
        $this->request->session()->put('authenticatedUser', $usu);
    }

    public function RemoveUserAuthenticated(): void
    {
        $this->request->session()->forget('authenticatedUser');
    }
}
