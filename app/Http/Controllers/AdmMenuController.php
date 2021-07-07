<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Base\Report\BaseViewReportController;
use App\Admin\Services\AdmMenuService;
use App\Admin\Services\AdmPageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Messages;
use App\Models\AdmMenu;
use App\Http\Requests\AdmMenuFormRequest;
use App\Base\Models\AlertMessageVO;
use App\Models\AdmPage;

class AdmMenuController extends BaseViewReportController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var AdmMenuService
     */
    private $service;

    /**
     * @var AdmPageService
     */
    private $servicePage;

    /**
     * @var AdmPage[]|null
     */
    private $listAdmPage;

    /**
     * @var AdmMenu[]|null
     */
    private $listAdmMenuParent;

    public function __construct(AdmMenuService $service, AdmPageService $servicePage)
    {
        $this->service = $service;
        $this->servicePage = $servicePage;

        $this->listAdmPage = array();
        $this->listAdmMenuParent = array();
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

    private function fillLists(array $params): array
    {
        $this->listAdmPage = $this->servicePage->findAll();
        $params['listAdmPages'] = $this->listAdmPage;

        $this->listAdmMenuParent = [];

        $listAdmMenus = $this->service->findAll();
        foreach ($listAdmMenus as $menu)
        {
            if (($menu->getAdmSubMenus() != null) && ($menu->getAdmPageAttribute() == null))
            {
                array_push($this->listAdmMenuParent, $menu);
            }
        }

        $params['listAdmMenuParents'] = $this->listAdmMenuParent;

        return $params;
    }

    private function filterLists(AdmMenu $bean): void
    {
        $page = new AdmPage();
        foreach ($this->listAdmPage as $item)
        {
            if ($item->getIdAttribute() === $bean->getIdPageAttribute())
            {
                $page = $item;
                break;
            }
        }

        if ($page!=null)
        {
            $bean->setIdPageAttribute($page->getIdAttribute());
        }

        $menuParent = new AdmMenu();
        foreach ($this->listAdmMenuParent as $item)
        {
            if ($item->getIdAttribute() === $bean->getIdMenuParentAttribute())
            {
                $menuParent = $item;
                break;
            }
        }

        if ($menuParent != null)
        {
            $bean->setIdMenuParentAttribute($menuParent->getIdAttribute());
        }
    }

    public function index(Request $request)
    {
        //$route = $request->path();
        //$model = $this->service->getPage($route);
        //$model = $this->service->findAll();
        $model = $this->getAuthenticatedUser($request)->getListAdminMenus();

        $params = $this->params($request, $model);

        return view('admMenu.index', $params);
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
            $params = $this->fillLists($params);
            $this->filterLists($model);

            return view('admMenu.edit', $params);
        }
        else
        {
            $model = new AdmMenu();
            $params = $this->params($request, $model);
            $params = $this->fillLists($params);

            return view('admMenu.edit', $params);
        }
    }

    public function save(AdmMenuFormRequest $request)
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
            $this->filterLists($request->model());
        }
        else
        {
            $model = $this->service->insert($request->all());
            $this->filterLists($model);
        }

        return redirect()->route('listAdmMenu');
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($id);
        return redirect()->route('listAdmMenu');
    }
}

