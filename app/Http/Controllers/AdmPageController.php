<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Base\Report\BaseViewReportController;
use App\Admin\Services\AdmPageService;
use App\Admin\Services\AdmProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Messages;
use App\Models\AdmPage;
use App\Http\Requests\AdmPageFormRequest;
use App\Base\Models\AlertMessageVO;
use App\Base\BaseDualList;

class AdmPageController extends BaseViewReportController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var AdmPageService
     */
    private $service;

    /**
     * @var AdmProfileService
     */
    private $admProfileService;

    /**
     * @var BaseDualList
     */
    private $dualListAdmProfile;

    /**
     * @var AdmProfile[]|null
     */
    private $listAllAdmProfiles;

    public function __construct(AdmPageService $service, AdmProfileService $admProfileService)
    {
        $this->service = $service;
        $this->admProfileService = $admProfileService;

        $this->listAllAdmProfiles = array();
    }

    private function params(Request $request, $model, bool $bEdit): array
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

    private function loadAdmProfiles(AdmPage $bean, bool $bEdit): BaseDualList
    {
        $listAdmProfilesSelected = array();
        $listAdmProfiles = array();
        $allprofiles = $this->admProfileService->findAll();
        foreach ($allprofiles as $item){
            array_push($listAdmProfiles, $item);
        }

        $listAllAdmProfiles = array();
        foreach ($listAdmProfiles as $item){
            array_push($listAllAdmProfiles, $item);
        }

        if ($bEdit)
        {
            $listAdmProfilesSelected = array();

            foreach ($listAdmProfiles as $profile)
            {
                foreach ($profile->getAdmPagesAttribute() as $page)
                {
                    if ($page === $bean)
                    {
                        array_push($listAdmProfilesSelected, $profile);
                        break;
                    }
                }
            }

            for ($x = count($listAdmProfiles)-1; $x >= 0; $x--)
            {
                $item = $listAdmProfiles[$x];

                if (in_array($item, $listAdmProfilesSelected, true))
                {
                    unset($listAdmProfiles[$x]);
                }
            }
        }
        else
        {
            $listAdmProfilesSelected = array();
        }

        $this->dualListAdmProfile = new BaseDualList($listAdmProfiles, $listAdmProfilesSelected);

        return $this->dualListAdmProfile;
    }

    public function index(Request $request)
    {
        //$route = $request->path();
        //$model = $this->service->getPage($route);
        $model = $this->service->findAll();

        $params = $this->params($request, $model, false);

        return view('admPage.index', $params);
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

            $this->dualListAdmProfile = $this->loadAdmProfiles($model, true);
            $listSourceAdmProfiles = $this->dualListAdmProfile->getSource();
            $listTargetAdmProfiles = $this->dualListAdmProfile->getTarget();

            $params = $this->params($request, $model, true);
            $params['listSourceAdmProfiles'] = $listSourceAdmProfiles;
            $params['listTargetAdmProfiles'] = $listTargetAdmProfiles;
            return view('admPage.edit', $params);
        }
        else
        {
            $model = new AdmPage();

            $this->dualListAdmProfile = $this->loadAdmProfiles($model, true);
            $listSourceAdmProfiles = $this->dualListAdmProfile->getSource();
            $listTargetAdmProfiles = $this->dualListAdmProfile->getTarget();

            $params = $this->params($request, $model, false);
            $params['listSourceAdmProfiles'] = $listSourceAdmProfiles;
            $params['listTargetAdmProfiles'] = $listTargetAdmProfiles;
            return view('admPage.edit', $params);
        }
    }

    public function save(AdmPageFormRequest $request)
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

        return redirect()->route('listAdmPage');
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($id);
        return redirect()->route('listAdmPage');
    }
}

