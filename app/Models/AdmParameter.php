<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmParameter extends Model
{
    /**
     * @var string
     */
    protected $table = 'adm_parameter';

    /**
     * @var string
     */
    protected $primaryKey = 'par_seq';

    /**
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;

    protected $maps = ['par_seq' => 'id', 'par_code' => 'code', 'par_description' => 'description',
        'par_pmc_seq' => 'idParameterCategory', 'par_value' => 'value'];
    protected $hidden = ['par_seq', 'par_code', 'par_description', 'par_pmc_seq', 'par_value'];
    protected $visible = ['id', 'code', 'description', 'idParameterCategory', 'value', 'admParameterCategory'];
    protected $appends = ['id', 'code', 'description', 'idParameterCategory', 'value', 'admParameterCategory'];
    protected $fillable = ['id', 'code', 'description', 'idParameterCategory', 'value'];

    public function getAdmParameterCategoryAttribute(): AdmParameterCategory
    {
        //return $this->hasOne(AdmParameterCategory::class, 'pmc_seq', 'par_pmc_seq');
        return AdmParameterCategory::find($this->getIdParameterCategoryAttribute());
    }

    public function getIdAttribute(): int
    {
        return $this->attributes['par_seq'];
    }

    public function setIdAttribute(int $value): void
    {
        $this->attributes['par_seq'] = $value;
    }

    public function getCodeAttribute(): string
    {
        return $this->attributes['par_code'];
    }

    public function setCodeAttribute(string $value): void
    {
        $this->attributes['par_code'] = $value;
    }

    public function getDescriptionAttribute(): string
    {
        return $this->attributes['par_description'];
    }

    public function setDescriptionAttribute(string $value): void
    {
        $this->attributes['par_description'] = $value;
    }

    public function getIdParameterCategoryAttribute(): int
    {
        return $this->attributes['par_pmc_seq'];
    }

    public function setIdParameterCategoryAttribute(int $value): void
    {
        $this->attributes['par_pmc_seq'] = $value;
    }

    public function getValueAttribute(): string | null
    {
        return $this->attributes['par_value'];
    }

    public function setValueAttribute(string | null $value): void
    {
        $this->attributes['par_value'] = $value;
    }

}
