<?php

namespace Modules\Register\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Register\presenters\FormPresenter;

class Form extends Model
{
    use PresentableTrait;

    protected $table = 'register__forms';
    protected $fillable = [
        'reference_no', 'company', 'identity_no', 'signatory', 'email', 'work_phone', 'mobile_phone', 'collateral_id', 'collateral_amount', 'monthly_consumption', 'credit_card', 'shipping_address', 'agreement1', 'agreement2'
    ];
    protected $casts = [
        'credit_card'            => 'object',
        'collateral_amount'      => 'float',
        'monthly_consumption'    => 'float'
    ];

    protected $presenter = FormPresenter::class;

    public function files()
    {
        return $this->hasMany(File::class, 'form_id', 'id');
    }

    public function collateral()
    {
        return $this->belongsTo(Collateral::class);
    }
}
