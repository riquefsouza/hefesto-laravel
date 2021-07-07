<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Base\Report\BaseViewReportController;
use App\Admin\Services\AdmUserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Messages;
use App\Models\AdmUser;
use App\Http\Requests\AdmUserFormRequest;
use App\Base\Models\AlertMessageVO;

class AdmUserController extends BaseViewReportController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var AdmUserService
     */
    private $service;

    public function __construct(AdmUserService $service)
    {
        $this->service = $service;
    }

    private function params(Request $request, $model): array
    {
        $messages = Messages::MESSAGES;

        $this->loadMessages($request);

        $alertMessage = $this->alertMessage;
        $menuItem = $this->menuItem;
        $userLogged = $this->userLogged;
        $listReportType = $this->getListReportType();

        if ($model!=null)
            return compact('messages', 'alertMessage',
                'menuItem', 'userLogged', 'listReportType', 'model');
        else
            return compact('messages', 'alertMessage',
                'menuItem', 'userLogged', 'listReportType');
    }

    public function index(Request $request)
    {
        //$route = $request->path();
        //$model = $this->service->getPage($route);
        $model = $this->service->findAll();

        $params = $this->params($request, $model);

        return view('admUser.index', $params);
    }

    public function edit(int|null $id, Request $request)
    {
        if ($id === null)
        {
            return Response::HTTP_NOT_FOUND;
        }

        if ($id > 0)
        {
            $model = $this->service->findById($id);
            if ($model == null)
            {
                return Response::HTTP_NOT_FOUND;
            }

            $params = $this->params($request, $model);
            return view('admUser.edit', $params);
        }
        else
        {
            $model = new AdmUser();
            $params = $this->params($request, $model);
            return view('admUser.edit', $params);
        }
    }

    public function save(AdmUserFormRequest $request)
    {
        if ($request->model()->getIdAttribute() > 0)
        {
            $updated = $this->service->update(
                $request->model()->getIdAttribute(), $request->all());
            if (!$updated)
            {
                //$request->session()->flash('message', "Not updated!");
                return Response::HTTP_NOT_FOUND;
            }
        }
        else
        {
            $this->service->insert($request->all());
        }

        return redirect()->route('listAdmUser');
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($id);
        return redirect()->route('listAdmUser');
    }
}

