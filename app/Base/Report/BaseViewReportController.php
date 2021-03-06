<?php

namespace App\Base\Report;

use App\Base\BaseController;
use App\Http\Controllers\Messages;

class BaseViewReportController extends BaseController
{
    /**
     * @return ReportGroupVO[]|null
     */
    public function getListReportType()
    {
        $listaVO = array();
        $listaEnum = ReportType::allTypes();
        $subtipos = array();

        foreach (ReportType::groups() as $grupo)
        {
            $igrupo = "";
            $subtipos = [];

            foreach ($listaEnum as $item)
            {
                if ($item->getGroup() === $grupo)
                {
                    array_push($subtipos, $item);
                }
            }

            if ($grupo === ReportType::groups()[0])
                $igrupo = Messages::MESSAGES["reportTypeGroups.docs"];
            if ($grupo === ReportType::groups()[1])
                $igrupo = Messages::MESSAGES["reportTypeGroups.sheets"];
            if ($grupo === ReportType::groups()[2])
                $igrupo = Messages::MESSAGES["reportTypeGroups.text"];
            if ($grupo === ReportType::groups()[3])
                $igrupo = Messages::MESSAGES["reportTypeGroups.others"];

            $grupoVO = new ReportGroupVO($igrupo, $subtipos);

            array_push($listaVO, $grupoVO);
        }

        return $listaVO;
    }

    /*
    protected function LoadMessages(): void
    {
        $this->LoadMessages();
        $this->listReportType = $this->getListReportType();
    }
    */
}
