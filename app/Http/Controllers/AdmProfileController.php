<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Base\Report\BaseViewReportController;
use App\Admin\Services\AdmProfileService;
use App\Admin\Services\AdmPageService;
use App\Admin\Services\AdmUserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Messages;
use App\Models\AdmProfile;
use App\Http\Requests\AdmProfileFormRequest;
use App\Base\Models\AlertMessageVO;
use App\Base\BaseDualList;

class AdmProfileController extends BaseViewReportController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var AdmProfileService
     */
    private $service;

    /**
     * @var AdmPageService
     */
    private $admPageService;

    /**
     * @var BaseDualList
     */
    private $dualListAdmPage;

    /**
     * @var AdmPage[]|null
     */
    private $listAllAdmPages;

    /**
     * @var AdmUserService
     */
    private $admUserService;

    /**
     * @var BaseDualList
     */
    private $dualListAdmUser;

    /**
     * @var AdmUser[]|null
     */
    private $listAllAdmUsers;

    public function __construct(AdmProfileService $service, AdmPageService $admPageService,
        AdmUserService $admUserService)
    {
        $this->service = $service;

        $this->admPageService = $admPageService;
        $this->admUserService = $admUserService;

        $this->listAllAdmPages = array();
        $this->listAllAdmUsers = array();
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

    private function loadAdmPages(AdmProfile $bean, bool $bEdit): BaseDualList
    {
        $listAdmPagesSelected = array();
        $listAdmPages = array();
        $allpages = $this->admPageService->findAll();
        foreach ($allpages as $item){
            array_push($listAdmPages, $item);
        }

        $listAllAdmPages = array();
        foreach ($listAdmPages as $item){
            array_push($listAllAdmPages, $item);
        }

        if ($bEdit)
        {
            $listAdmPagesSelected = array();

            foreach ($listAdmPages as $page)
            {
                foreach ($page->getAdmIdProfilesAttribute() as $profileId)
                {
                    if ($profileId === $bean->getIdAttribute())
                    {
                        array_push($listAdmPagesSelected, $page);
                        break;
                    }
                }
            }

            for ($x = count($listAdmPages)-1; $x >= 0; $x--)
            {
                $item = $listAdmPages[$x];

                if (in_array($item, $listAdmPagesSelected, true))
                {
                    unset($listAdmPages[$x]);
                }
            }
        }
        else
        {
            $listAdmPagesSelected = array();
        }

        $this->dualListAdmPage = new BaseDualList($listAdmPages, $listAdmPagesSelected);

        return $this->dualListAdmPage;
    }

    private function loadAdmUsers(AdmProfile $bean, bool $bEdit): BaseDualList
    {
        $listAdmUsersSelected = array();
        $listAdmUsers = array();
        $allusers = $this->admUserService->findAll();
        foreach ($allusers as $item){
            array_push($listAdmUsers, $item);
        }

        $listAllAdmUsers = array();
        foreach ($listAdmUsers as $item){
            array_push($listAllAdmUsers, $item);
        }

        if ($bEdit)
        {
            $listAdmUsersSelected = array();

            foreach ($listAdmUsers as $user)
            {
                foreach ($user->getAdmIdProfilesAttribute() as $profileId)
                {
                    if ($profileId === $bean->getIdAttribute())
                    {
                        array_push($listAdmUsersSelected, $user);
                        break;
                    }
                }
            }

            for ($x = count($listAdmUsers)-1; $x >= 0; $x--)
            {
                $item = $listAdmUsers[$x];

                if (in_array($item, $listAdmUsersSelected, true))
                {
                    unset($listAdmUsers[$x]);
                }
            }
        }
        else
        {
            $listAdmUsersSelected = array();
        }

        $this->dualListAdmUser = new BaseDualList($listAdmUsers, $listAdmUsersSelected);

        return $this->dualListAdmUser;
    }

    private function fillLists(Request $request,
        AdmProfile $model, bool $bEdit): array
    {
        $this->dualListAdmPage = $this->loadAdmPages($model, $bEdit);
        $listSourceAdmPages = $this->dualListAdmPage->getSource();
        $listTargetAdmPages = $this->dualListAdmPage->getTarget();

        $this->dualListAdmUser = $this->loadAdmUsers($model, $bEdit);
        $listSourceAdmUsers = $this->dualListAdmUser->getSource();
        $listTargetAdmUsers = $this->dualListAdmUser->getTarget();

        $params = $this->params($request, $model);
        $params['listSourceAdmPages'] = $listSourceAdmPages;
        $params['listTargetAdmPages'] = $listTargetAdmPages;

        $params['listSourceAdmUsers'] = $listSourceAdmUsers;
        $params['listTargetAdmUsers'] = $listTargetAdmUsers;

        return $params;
    }

    public function index(Request $request)
    {
        //$route = $request->path();
        //$model = $this->service->getPage($route);
        $model = $this->service->findAll();

        $params = $this->params($request, $model);

        return view('admProfile.index', $params);
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

            $params = $this->fillLists($request, $model, true);

            return view('admProfile.edit', $params);
        }
        else
        {
            $model = new AdmProfile();

            $params = $this->fillLists($request, $model, false);

            return view('admProfile.edit', $params);
        }
    }

    public function save(AdmProfileFormRequest $request)
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

        return redirect()->route('listAdmProfile');
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($id);
        return redirect()->route('listAdmProfile');
    }
}

