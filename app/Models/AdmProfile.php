<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Admin\VO\ProfileVO;

class AdmProfile extends Model
{

    /**
     * @var string
     */
    protected $table = 'adm_profile';

    /**
     * @var string
     */
    protected $primaryKey = 'prf_seq';

    /**
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;

    protected $maps = ['prf_seq' => 'id', 'prf_administrator' => 'administrator',
        'prf_description' => 'description', 'prf_general' => 'general'];
    protected $hidden = ['prf_seq', 'prf_administrator', 'prf_description', 'prf_general'];
    protected $visible = ['id', 'administrator', 'description', 'general', 'admPages', 'admUsers', 'profilePages', 'profileUsers'];
    protected $appends = ['id', 'administrator', 'description', 'general', 'admPages', 'admUsers', 'profilePages', 'profileUsers'];
    protected $fillable = ['id', 'administrator', 'description', 'general'];

    /**
     * @return AdmPage[]|null
     */
    private $admPages = array();

    /**
     * @return AdmUser[]|null
     */
    private $admUsers = array();

    /**
     * @var string|null
     */
    private $profilePages;

    /**
     * @var string|null
     */
    private $profileUsers;

    public function __construct()
    {
        $this->setIdAttribute(0);
        $this->setAdministratorAttribute("N");
        $this->setDescriptionAttribute("");
        $this->setGeneralAttribute("N");
        $this->setAdmPagesAttribute([]);
        $this->setAdmUsersAttribute([]);
        $this->setProfilePagesAttribute("");
        $this->setProfileUsersAttribute("");
    }

    public function admPageProfiles()
    {
        return $this->hasMany(AdmPageProfile::class);
    }

    public function admUserProfiles()
    {
        return $this->hasMany(AdmUserProfile::class);
    }

    public function getIdAttribute(): int
    {
        return $this->attributes['prf_seq'];
    }

    public function setIdAttribute(int $value): void
    {
        $this->attributes['prf_seq'] = $value;
    }

    public function getAdministratorAttribute(): string
    {
        return $this->attributes['prf_administrator'];
    }

    public function setAdministratorAttribute(string $value): void
    {
        $this->attributes['prf_administrator'] = $value;
    }

    public function getDescriptionAttribute(): string
    {
        return $this->attributes['prf_description'];
    }

    public function setDescriptionAttribute(string $value): void
    {
        $this->attributes['prf_description'] = $value;
    }

    public function getGeneralAttribute(): string
    {
        return $this->attributes['prf_general'];
    }

    public function setGeneralAttribute(string $value): void
    {
        $this->attributes['prf_general'] = $value;
    }

    /**
     * @return AdmPage[]|null
     */
    public function &getAdmPagesAttribute()
    {
        return $this->admPages;
    }

    public function setAdmPagesAttribute(array $admPages): self
    {
        $this->admPages = $admPages;

        return $this;
    }

    /**
     * @return AdmUser[]|null
     */
    public function &getAdmUsersAttribute()
    {
        return $this->admUsers;
    }

    public function setAdmUsersAttribute(array $admUsers): self
    {
        $this->admUsers = $admUsers;

        return $this;
    }

    public function getProfilePagesAttribute(): ?string
    {
        return $this->profilePages;
    }

    public function setProfilePagesAttribute(?string $profilePages): self
    {
        $this->profilePages = $profilePages;

        return $this;
    }

    public function getProfileUsersAttribute(): ?string
    {
        return $this->profileUsers;
    }

    public function setProfileUsersAttribute(?string $profileUsers): self
    {
        $this->profileUsers = $profileUsers;

        return $this;
    }

    /**
     * @return ProfileVO
     */
    public function toProfileVO(): ProfileVO
    {
        $p = new ProfileVO();

        $p->setId($this->getIdAttribute());
        $p->setAdministrator($this->getAdministratorAttribute());
        $p->setDescription($this->getDescriptionAttribute());
        $p->setGeneral($this->getGeneralAttribute());

        foreach ($this->getAdmPagesAttribute() as $admPagina)
        {
            array_push($p->getPages(), $admPagina->toPageVO());
        }

        foreach ($this->getAdmUsersAttribute() as $admUser)
        {
            array_push($p->getUsers(), $admUser->toUserVO());
        }

        return $p;
    }

}
