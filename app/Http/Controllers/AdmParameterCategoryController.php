<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Base\Report\BaseViewReportController;
use App\Admin\Services\AdmParameterCategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Messages;
use App\Models\AdmParameterCategory;

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

    public function index(Request $request) {

        $messages = Messages::MESSAGES;

        $this->loadMessages($request);

        $alertMessage = $this->alertMessage;
        $menuItem = $this->menuItem;
        $userLogged = $this->userLogged;

        //$model = $this->service->getPage()
        $model = AdmParameterCategory::paginate(2);

        return view('admParameterCategory.index',
            compact('messages', 'alertMessage', 'menuItem', 'userLogged', 'model'));
    }
}

