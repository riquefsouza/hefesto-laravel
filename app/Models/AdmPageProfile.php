<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmPageProfile extends Model
{

    /**
     * @var string
     */
    protected $table = 'adm_page_profile';

    /**
     * @var string
     */
    protected $primaryKey = 'pgl_seq';

    /**
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;

    protected $maps = ['pgl_seq' => 'id', 'pgl_prf_seq' => 'idProfile', 'pgl_pag_seq' => 'idPage'];
    protected $hidden = ['pgl_seq', 'pgl_prf_seq', 'pgl_pag_seq'];
    protected $visible = ['id', 'idProfile', 'idPage', 'admPage', 'admProfile'];
    protected $appends = ['id', 'idProfile', 'idPage', 'admPage', 'admProfile'];
    protected $fillable = ['id', 'idProfile', 'idPage'];

    public function getAdmPageAttribute(): AdmPage
    {
        return AdmPage::find($this->getIdPageAttribute());
    }

    public function getAdmProfileAttribute(): AdmProfile
    {
        return AdmProfile::find($this->getIdProfileAttribute());
    }

    public function getIdAttribute(): int
    {
        return $this->attributes['pag_seq'];
    }

    public function setIdAttribute(int $value): void
    {
        $this->attributes['pag_seq'] = $value;
    }

    public function getIdProfileAttribute(): int
    {
        return $this->attributes['pgl_prf_seq'];
    }

    public function setIdProfileAttribute(int $value): void
    {
        $this->attributes['pgl_prf_seq'] = $value;
    }

    public function getIdPageAttribute(): int
    {
        return $this->attributes['pgl_pag_seq'];
    }

    public function setIdPageAttribute(int $value): void
    {
        $this->attributes['pgl_pag_seq'] = $value;
    }

}
