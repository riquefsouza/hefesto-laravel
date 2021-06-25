<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmPage extends Model
{

    /**
     * @var string
     */
    protected $table = 'adm_page';

    /**
     * @var string
     */
    protected $primaryKey = 'pag_seq';

    /**
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;

    protected $maps = ['pag_seq' => 'id', 'pag_description' => 'description', 'pag_url' => 'url'];
    protected $hidden = ['pag_seq', 'pag_description', 'pag_url'];
    protected $visible = ['id', 'description', 'url', 'admIdProfiles', 'pageProfiles'];
    protected $appends = ['id', 'description', 'url', 'admIdProfiles', 'pageProfiles'];
    protected $fillable = ['id', 'description', 'url'];

    /**
     * @var int[]|null
     */
    private $admIdProfiles = array();

    /**
     * @var string|null
     */
    private $pageProfiles;

    public function admMenus()
    {
        return $this->hasMany(AdmMenu::class);
    }

    public function admPageProfiles()
    {
        return $this->hasMany(AdmPageProfile::class);
    }

    public function getIdAttribute(): int
    {
        return $this->attributes['pag_seq'];
    }

    public function setIdAttribute(int $value): void
    {
        $this->attributes['pag_seq'] = $value;
    }

    public function getDescriptionAttribute(): string
    {
        return $this->attributes['pag_description'];
    }

    public function setDescriptionAttribute(string $value): void
    {
        $this->attributes['pag_description'] = $value;
    }

    public function getUrlAttribute(): string
    {
        return $this->attributes['pag_url'];
    }

    public function setUrlAttribute(string $value): void
    {
        $this->attributes['pag_url'] = $value;
    }

    /**
     * @return int[]|null
     */
    public function &getAdmIdProfilesAttribute()
    {
        return $this->admIdProfiles;
    }

    public function setAdmIdProfilesAttribute(array $admIdProfiles): self
    {
        $this->admIdProfiles = $admIdProfiles;

        return $this;
    }

    public function getPageProfilesAttribute(): ?string
    {
        return $this->pageProfiles;
    }

    public function setPageProfilesAttribute(?string $pageProfiles): self
    {
        $this->pageProfiles = $pageProfiles;

        return $this;
    }

}
