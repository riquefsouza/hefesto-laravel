<?php

namespace App\Admin\Services;

use App\Models\AdmUser;
use App\Admin\Services\AdmUserProfileService;
use Illuminate\Database\Eloquent\Collection;
use App\Base\Services\IBaseCrud;
use App\Base\Pagination\PaginationFilter;
use App\Base\Pagination\BasePaged;
use App\Base\Pagination\BasePaging;

class AdmUserService implements IBaseCrud
{
    /**
     * @var AdmUserProfileService
     */
    private $service;

    public function __construct(AdmUserProfileService $service) {
        $this->service = $service;
    }

    public function setTransientList(Collection $list): void
    {
        foreach ($list as $item)
        {
            $this->setTransient($item);
        }
    }

    public function setTransient(AdmUser $item): void
    {
        $obj = $this->service->getProfilesByUser($item->getIdAttribute());
        foreach ($obj as $profile) {
            array_push($item->getAdmIdProfilesAttribute(), $profile->getIdAttribute());
        }

        $listUserProfiles = array();
        foreach ($obj as $profile) {
            array_push($listUserProfiles, $profile->getDescriptionAttribute());
        }
        $item->setUserProfilesAttribute(implode(",", $listUserProfiles));
    }

    /**
     * @return AdmUser|null
     */
    public function findOneUserByLogin(string $login): AdmUser|null {
        return AdmUser::where('usu_login', $login)->first();
    }

    public function authenticate(string $login, string $password): AdmUser|null
    {
        $admUser = $this->findOneUserByLogin($login);

        if ($admUser != null){
            if ($this->verifyPassword($password, $admUser->getPasswordAttribute())){
                return $admUser;
            }
        }
        return null;
    }

    public function verifyPassword(string $password, string $hashPassword): bool
    {
        return password_verify($password, $hashPassword);
    }

    public function register(AdmUser $model): void
    {
        $model->setPassword(password_hash($model->getPasswordAttribute(), PASSWORD_DEFAULT));
        /*
        $options = [
            'cost' => 10
        ];
        $model->setPassword(password_hash($model->getPassword(), PASSWORD_BCRYPT, $options));
        */
    }

    /**
     * @return BasePaged
     */
    public function getPage(string $route, PaginationFilter $filter): BasePaged
    {
        $validFilter = new PaginationFilter($filter->getPageNumber(), $filter->getSize(),
            $filter->getSort(), $filter->getColumnOrder(), $filter->getColumnTitle());

        //$pagedData = AdmUser::paginate(15);
        $pagedData = AdmUser::skip(($validFilter->getPageNumber() - 1) * $validFilter->getSize())
            ->take($validFilter->getSize())->get();
        //$pagedData = AdmUser::offset(0)->limit(10)->get();
        $totalRecords = AdmUser::count();

        return new BasePaged($pagedData,
            BasePaging::of($validFilter, $totalRecords, $this->uriService, $route));
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $list = AdmUser::all();
        $this->setTransientList($list);

        return $list;
    }

    /**
     * @return AdmUser|null
     */
    public function findById(int $id)
    {
        $obj = AdmUser::find($id);
        if (!is_null($obj)) {
            $this->setTransient($obj);
        }

        return $obj;

    }

    /**
     * @return bool
     */
    public function update(int $id, $obj): bool
    {
        $model = AdmUser::find($id);
        if (is_null($model)) {
            return false;
        }
        $model->fill($obj);
        $model->save();

        return true;
    }

    /**
     * @return AdmUser
     */
    public function insert($obj)
    {
        $model = new AdmUser();
        $model->fill($obj);
        $model->save();

        return $model;
        //return AdmUser::create($obj);
    }

    /**
     * @return bool
     */
    public function delete(int $id): bool
    {
        $qty = AdmUser::destroy($id);
        return ($qty !== 0);
    }

    /**
     * @return bool
     */
    public function exists(int $id): bool
    {
        $model = AdmUser::find($id);
        return (!is_null($model));
    }
}
