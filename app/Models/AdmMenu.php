<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class AdmMenu extends Model
{

    /**
     * @var string
     */
    protected $table = 'adm_menu';

    /**
     * @var string
     */
    protected $primaryKey = 'mnu_seq';

    /**
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;

    protected $maps = ['mnu_seq' => 'id', 'mnu_description' => 'description', 'mnu_parent_seq' => 'idMenuParent',
        'mnu_pag_seq' => 'idPage', 'mnu_order' => 'order'];
    protected $hidden = ['mnu_seq', 'mnu_description', 'mnu_parent_seq', 'mnu_pag_seq', 'mnu_order'];
    protected $visible = ['id', 'description', 'idMenuParent', 'idPage', 'order', 'admPage', 'admMenuParent'];
    protected $appends = ['id', 'description', 'idMenuParent', 'idPage', 'order', 'admPage', 'admMenuParent'];
    protected $fillable = ['id', 'description', 'idMenuParent', 'idPage', 'order'];

    /**
     * @var Collection
     */
    private $admSubMenus;

    public function getAdmPageAttribute(): AdmPage | null
    {
        return AdmPage::find($this->getIdPageAttribute());
    }

    public function getAdmMenuParentAttribute(): AdmMenu | null
    {
        return AdmMenu::find($this->getIdMenuParentAttribute());
    }

    public function admSubMenus()
    {
        return $this->hasMany(AdmMenu::class);
    }

    public function getIdAttribute(): int
    {
        return $this->attributes['mnu_seq'];
    }

    public function setIdAttribute(int $value): void
    {
        $this->attributes['mnu_seq'] = $value;
    }

    public function getDescriptionAttribute(): string
    {
        return $this->attributes['mnu_description'];
    }

    public function setDescriptionAttribute(string $value): void
    {
        $this->attributes['mnu_description'] = $value;
    }

    public function getIdMenuParentAttribute(): int | null
    {
        return $this->attributes['mnu_parent_seq'];
    }

    public function setIdMenuParentAttribute(int | null $value): void
    {
        $this->attributes['mnu_parent_seq'] = $value;
    }

    public function getIdPageAttribute(): int | null
    {
        return $this->attributes['mnu_pag_seq'];
    }

    public function setIdPageAttribute(int | null $value): void
    {
        $this->attributes['mnu_pag_seq'] = $value;
    }

    public function getOrderAttribute(): int | null
    {
        return $this->attributes['mnu_order'];
    }

    public function setOrderAttribute(int | null $value): void
    {
        $this->attributes['mnu_order'] = $value;
    }

    public function getUrlAttribute(): string|null
    {
		return $this->getAdmPageAttribute() != null ? $this->getAdmPageAttribute()->getUrlAttribute() : null;
	}

    public function getAdmSubMenus()
    {
        return $this->admSubMenus;
    }

    public function setAdmSubMenus(Collection $admSubMenus): self
    {
        $this->admSubMenus = $admSubMenus;

        return $this;
    }
}
