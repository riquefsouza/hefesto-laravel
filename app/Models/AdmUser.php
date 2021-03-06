<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Admin\VO\UserVO;

class AdmUser extends Model
{

    /**
     * @var string
     */
    protected $table = 'adm_user';

    /**
     * @var string
     */
    protected $primaryKey = 'usu_seq';

    /**
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;

    protected $maps = ['usu_seq' => 'id', 'usu_active' => 'active', 'usu_email' => 'email',
        'usu_login' => 'login', 'usu_name' => 'name', 'usu_password' => 'password'];
    protected $hidden = ['usu_seq', 'usu_active', 'usu_email', 'usu_login', 'usu_name', 'usu_password'];
    protected $visible = ['id', 'active', 'email', 'login', 'name', 'password',
        'admIdProfiles', 'userProfiles', 'currentPassword', 'newPassword', 'confirmNewPassword'];
    protected $appends = ['id', 'active', 'email', 'login', 'name', 'password',
        'admIdProfiles', 'userProfiles', 'currentPassword', 'newPassword', 'confirmNewPassword'];
    protected $fillable = ['id', 'active', 'email', 'login', 'name', 'password'];

    /**
     * @var int[]|null
     */
    private $admIdProfiles = array();

    /**
     * @var string|null
     */
    private $userProfiles;

    /**
     * @var string|null
     */
    private $currentPassword;

    /**
     * @var string|null
     */
    private $newPassword;

        /**
     * @var string|null
     */
    private $confirmNewPassword;

    public function __construct()
    {
        $this->setIdAttribute(0);
        $this->setActiveAttribute("N");
        $this->setEmailAttribute(null);
        $this->setLoginAttribute("");
        $this->setNameAttribute("");
        $this->setPasswordAttribute("");
        $this->setAdmIdProfilesAttribute([]);
        $this->setUserProfilesAttribute("");
        $this->setCurrentPasswordAttribute("");
        $this->setNewPasswordAttribute("");
        $this->setConfirmNewPasswordAttribute("");
    }

    public function admUserProfiles()
    {
        return $this->hasMany(AdmUserProfile::class);
    }

    public function getIdAttribute(): int
    {
        return $this->attributes['usu_seq'];
    }

    public function setIdAttribute(int $value): void
    {
        $this->attributes['usu_seq'] = $value;
    }

    public function getActiveAttribute(): string
    {
        return $this->attributes['usu_active'];
    }

    public function setActiveAttribute(string $value): void
    {
        $this->attributes['usu_active'] = $value;
    }

    public function getActive(): bool
    {
        return ($this->attributes['usu_active'] === 'S');
    }

    public function setActive(bool $value): void
    {
        $this->attributes['usu_active'] = ($value === 'S');
    }

    public function getEmailAttribute(): string | null
    {
        return $this->attributes['usu_email'];
    }

    public function setEmailAttribute(string | null $value): void
    {
        $this->attributes['usu_email'] = $value;
    }

    public function getLoginAttribute(): string
    {
        return $this->attributes['usu_login'];
    }

    public function setLoginAttribute(string $value): void
    {
        $this->attributes['usu_login'] = $value;
    }

    public function getNameAttribute(): string | null
    {
        return $this->attributes['usu_name'];
    }

    public function setNameAttribute(string | null $value): void
    {
        $this->attributes['usu_name'] = $value;
    }

    public function getPasswordAttribute(): string
    {
        return $this->attributes['usu_password'];
    }

    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['usu_password'] = $value;
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

    public function getUserProfilesAttribute(): ?string
    {
        return $this->userProfiles;
    }

    public function setUserProfilesAttribute(?string $userProfiles): self
    {
        $this->userProfiles = $userProfiles;

        return $this;
    }

    public function getCurrentPasswordAttribute(): ?string
    {
        return $this->currentPassword;
    }

    public function setCurrentPasswordAttribute(?string $currentPassword): self
    {
        $this->currentPassword = $currentPassword;

        return $this;
    }

    public function getNewPasswordAttribute(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPasswordAttribute(?string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmNewPasswordAttribute(): ?string
    {
        return $this->confirmNewPassword;
    }

    public function setConfirmNewPasswordAttribute(?string $confirmNewPassword): self
    {
        $this->confirmNewPassword = $confirmNewPassword;

        return $this;
    }

    public function CreateFromUserVO(UserVO $vo)
    {
        $this->setIdAttribute($vo->getId());
        $this->setActiveAttribute($vo->getActive());
        $this->setEmailAttribute($vo->getEmail());
        $this->setLoginAttribute($vo->getLogin());
        $this->setNameAttribute($vo->getName());
        //$this->setPasswordAttribute($vo->getPassword());
        $this->setAdmIdProfilesAttribute($vo->getAdmIdProfiles());
        $this->setUserProfilesAttribute($vo->getUserProfiles());
        $this->setCurrentPasswordAttribute($vo->getCurrentPassword());
        $this->setNewPasswordAttribute($vo->getNewPassword());
        $this->setConfirmNewPasswordAttribute($vo->getConfirmNewPassword());
    }

    public function toUserVO(): UserVO
    {
        $u = new UserVO();

        $u->setId($this->getIdAttribute());
        //$u->setIp($this->getIpAttribute());
        $u->setEmail($this->getEmailAttribute());
        $u->setLogin($this->getLoginAttribute());
        $u->setName($this->getNameAttribute());

        return $u;
    }

}
