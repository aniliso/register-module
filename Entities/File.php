<?php

namespace Modules\Register\Entities;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'register__files';
    protected $fillable = ['form_id', 'name','type','size'];

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id', 'id');
    }
}
