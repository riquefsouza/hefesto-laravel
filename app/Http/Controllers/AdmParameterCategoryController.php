<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Base\Report\BaseViewReportController;
use App\Admin\Services\AdmParameterCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Messages;
use App\Models\AdmParameterCategory;
use App\Http\Requests\AdmParameterCategoryFormRequest;

class AdmParameterCategoryController extends BaseViewReportController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var AdmParameterCategoryService
     */
    private $service;

    public function __construct(AdmParameterCategoryService $service)
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
            return compact('messages', 'alertMessage', 'menuItem', 'userLogged', 'listReportType', 'model');
        else
            return compact('messages', 'alertMessage', 'menuItem', 'userLogged', 'listReportType');
    }

    public function index(Request $request)
    {
        //$route = $request->path();
        //$model = $this->service->getPage($route);
        $model = AdmParameterCategory::paginate(10);

        $params = $this->params($request, $model);

        return view('admParameterCategory.index', $params);
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
            return view('admParameterCategory.edit', $params);
        }
        else
        {
            $model = new AdmParameterCategory();
            $params = $this->params($request, $model);
            return view('admParameterCategory.edit', $params);
        }
    }

    public function save(AdmParameterCategoryFormRequest $request)
    {
        //$admParameterCategory = $request->all();
        //var_dump($request->model()->getDescriptionAttribute());


        if ($request->model()->getIdAttribute() > 0)
        {
            //if (ModelState.IsValid)
            //{
                $updated = $this->service->update(
                    $request->model()->getIdAttribute(), $request->all());
                if (!$updated)
                {
                    //$request->session()->flash('message', "Not updated!");
                    return Response::HTTP_NOT_FOUND;
                }
            //}
        }
        else
        {
            //if (ModelState.IsValid)
            //{
                $this->service->insert($request->all());
            //}
        }

        return redirect()->route('listAdmParameterCategory');

    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($id);
        //$params = $this->params($request, null);
        //return view('admParameterCategory.index', $params);
        return redirect()->route('listAdmParameterCategory');
    }
}

