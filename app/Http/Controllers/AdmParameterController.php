<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Base\Report\BaseViewReportController;
use App\Admin\Services\AdmParameterService;
use App\Admin\Services\AdmParameterCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Messages;
use App\Models\AdmParameter;
use App\Http\Requests\AdmParameterFormRequest;
use App\Base\Models\AlertMessageVO;

class AdmParameterController extends BaseViewReportController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var AdmParameterService
     */
    private $service;

    /**
     * @var AdmParameterCategoryService
     */
    private $serviceParameterCategory;

    public function __construct(AdmParameterService $service,
        AdmParameterCategoryService $serviceParameterCategory)
    {
        $this->service = $service;
        $this->serviceParameterCategory = $serviceParameterCategory;
    }

    private function params(Request $request, $model): array
    {
        $messages = Messages::MESSAGES;

        $this->loadMessages($request);

        $alertMessage = $this->alertMessage;
        $menuItem = $this->menuItem;
        $userLogged = $this->userLogged;
        $listReportType = $this->getListReportType();
        $listAdmCategories = $this->serviceParameterCategory->findAll();

        if ($model!=null)
            return compact('messages', 'alertMessage', 'menuItem', 'userLogged',
                'listReportType', 'listAdmCategories', 'model');
        else
            return compact('messages', 'alertMessage', 'menuItem', 'userLogged',
                'listReportType', 'listAdmCategories');
    }

    public function index(Request $request)
    {
        //$route = $request->path();
        //$model = $this->service->getPage($route);
        $model = $this->service->findAll();

        $params = $this->params($request, $model);

        return view('admParameter.index', $params);
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
            return view('admParameter.edit', $params);
        }
        else
        {
            $model = new AdmParameter();
            $params = $this->params($request, $model);
            return view('admParameter.edit', $params);
        }
    }

    public function save(AdmParameterFormRequest $request)
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

        return redirect()->route('listAdmParameter');
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($id);
        return redirect()->route('listAdmParameter');
    }
}

