<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmUserProfile extends Model
{

    /**
     * @var string
     */
    protected $table = 'adm_user_profile';

    /**
     * @var string
     */
    protected $primaryKey = 'usp_seq';

    /**
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;

    protected $maps = ['usp_seq' => 'id', 'usp_prf_seq' => 'idProfile', 'usp_use_seq' => 'idUser'];
    protected $hidden = ['usp_seq', 'usp_prf_seq', 'usp_use_seq'];
    protected $visible = ['id', 'idProfile', 'idUser', 'admUser', 'admProfile'];
    protected $appends = ['id', 'idProfile', 'idUser', 'admUser', 'admProfile'];
    protected $fillable = ['id', 'idProfile', 'idUser'];

    public function getAdmUserAttribute(): AdmUser
    {
        return AdmUser::find($this->getIdUserAttribute());
    }

    public function getAdmProfileAttribute(): AdmProfile
    {
        return AdmProfile::find($this->getIdProfileAttribute());
    }

    public function getIdAttribute(): int
    {
        return $this->attributes['usp_seq'];
    }

    public function setIdAttribute(int $value): void
    {
        $this->attributes['usp_seq'] = $value;
    }

    public function getIdProfileAttribute(): int
    {
        return $this->attributes['usp_prf_seq'];
    }

    public function setIdProfileAttribute(int $value): void
    {
        $this->attributes['usp_prf_seq'] = $value;
    }

    public function getIdUserAttribute(): int
    {
        return $this->attributes['usp_use_seq'];
    }

    public function setIdUserAttribute(int $value): void
    {
        $this->attributes['usp_use_seq'] = $value;
    }

}
