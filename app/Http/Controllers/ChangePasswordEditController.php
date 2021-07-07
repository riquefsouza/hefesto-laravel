<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Messages;
use App\Admin\Services\AdmUserService;
use App\Admin\Services\ChangePasswordService;
use App\Base\Models\AlertMessageVO;
use App\Admin\VO\UserVO;
use App\Http\Requests\AdmUserFormRequest;

class ChangePasswordEditController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var AdmUserService
     */
    private $service;

    /**
     * @var ChangePasswordService
     */
    private $changePasswordService;

    /**
     * @var UserVO
     */
    private $userLogged;

    /**
     * @var AlertMessageVO
     */
    private $alertMessage;

    public function __construct(AdmUserService $service,
        ChangePasswordService $changePasswordService)
    {
        $this->service = $service;
        $this->changePasswordService = $changePasswordService;
    }

    private function params(Request $request, $model): array
    {
        $messages = Messages::MESSAGES;

        $this->loadMessages($request);

        $alertMessage = $this->alertMessage;
        $menuItem = $this->menuItem;
        $userLogged = $this->getAuthenticatedUser($request)->getUser();

        if ($model!=null)
            return compact('messages', 'alertMessage',
                'menuItem', 'userLogged', 'model');
        else
            return compact('messages', 'alertMessage',
                'menuItem', 'userLogged');
    }

    public function prepareToSave(UserVO $user): bool
    {
        if (($user->getNewPassword() == null && $user->getConfirmNewPassword() == null && $user->getCurrentPassword() == null)
                || ($user->getNewPassword() === "" && $user->getConfirmNewPassword() === "" && $user->getCurrentPassword() === ""))
        {
            $this->alertMessage = AlertMessageVO::Warning("changePasswordView.validation");
        }
        else if (($user->getNewPassword() == null && $user->getConfirmNewPassword() == null)
              || ($user->getNewPassword() === "" && $user->getConfirmNewPassword() === ""))
        {
            $this->alertMessage = AlertMessageVO::Warning("changePasswordView.validation");
        }
        else
        {
            if ($user->getNewPassword() === $user->getConfirmNewPassword())
            {
                return true;
            }
            else
            {
                $this->alertMessage = AlertMessageVO::Warning("changePasswordView.notEqual");
            }
        }
        return false;
    }

    public function validatePassword(UserVO $user): bool
    {
        if (!$this->changePasswordService->validatePassword($user->getLogin(), $user->getCurrentPassword()))
        {
            $this->alertMessage = AlertMessageVO::Warning("changePasswordView.validatePassword");
            return false;
        }

        if (!$this->changePasswordService->validatePassword($user->getLogin(), $user->getNewPassword()))
        {
            $this->alertMessage = AlertMessageVO::Warning("changePasswordView.validatePassword");
            return false;
        }
        return true;
    }

    public function index(Request $request)
    {
        $params = $this->params($request, null);

        return view('changePasswordEdit.index', $params);
    }

    public function save(AdmUserFormRequest $request)
    {
        $user = new UserVO();
        $user->CreateWithAdmUser($request->model());

        if (!$this->prepareToSave($user))
        {
            $params = $this->params($request, $request->model());
            return view('changePasswordEdit.index', $params);
        }

        if (!$this->validatePassword($user))
        {
            $params = $this->params($request, $request->model());
            return view('changePasswordEdit.index', $params);
        }

        if ($request->model()->getIdAttribute() > 0)
        {
            $pwdCrypt = password_hash($user->getConfirmNewPassword(), PASSWORD_DEFAULT);

            $admUser = $request->model(); //$request->all()
            $admUser->setPasswordAttribute($pwdCrypt);

            $updated = $this->service->update($admUser->getIdAttribute(), $admUser);
            if (!$updated)
            {
                //$request->session()->flash('message', "Not updated!");
                return Response::HTTP_NOT_FOUND;
            }

            $this->alertMessage = AlertMessageVO::Info("changePasswordView.passwordChanged");
        }

        $params = $this->params($request, $admUser);
        return view('changePasswordEdit.index', $params);
    }

}
