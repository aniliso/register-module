<?php

namespace Modules\Register\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Media\Support\Traits\MediaRelation;

class Collateral extends Model
{
    use MediaRelation, PresentableTrait;

    protected $table = 'register__collaterals';
    protected $fillable = ['title', 'code', 'rates'];
}
