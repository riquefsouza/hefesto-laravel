<?php

namespace App\Base;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use App\Base\Models\AlertMessageVO;
use App\Admin\VO\UserVO;
use App\Admin\VO\AuthenticatedUserVO;
use Illuminate\Http\Request;
use App\Resources\Lang\PtBR\Messages;

class BaseController extends Controller
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $alertMessage;

    protected $userLogged;

    protected $menuItem;

    public function __construct() { }

    protected function loadMessages(Request $request): void
    {
        $this->loadMessagesWithAlertMessage($request, null);
    }

    protected function loadMessagesWithAlertMessage(Request $request,
        AlertMessageVO|null $alertMessage): void
    {
        if ($alertMessage == null)
            $this->alertMessage = new AlertMessageVO();
        else
            $this->alertMessage = $alertMessage;

        $authenticatedUser = $this->getAuthenticatedUser($request);

        if ($authenticatedUser!=null)
        {
            $authenticatedUser->User->Active = true;
            $this->userLogged = $authenticatedUser->User;

            $listMenus = $authenticatedUser->getListAdminMenus();

            $this->menuItem = $listMenus;
        } else
        {
            $this->userLogged = new UserVO();
            $this->userLogged->Active = false;

            $this->menuItem = array();
        }

    }

    public function getAuthenticatedUser(Request $request): AuthenticatedUserVO|null
    {
        //AuthenticatedUserVO
        if ($request->session()->has('authenticatedUser'))
            return $request->session()->get('authenticatedUser');
        else
            return null;
    }

    public function setUserAuthenticated(Request $request, AuthenticatedUserVO $usu): void
    {
        $request->session()->put('authenticatedUser', $usu);
    }

    public function removeUserAuthenticated(Request $request): void
    {
        $request->session()->forget('authenticatedUser');
    }
}
