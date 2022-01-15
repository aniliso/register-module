<?php


namespace Modules\Register\presenters;


use Modules\Core\Presenters\BasePresenter;

class FormPresenter extends BasePresenter
{
    public function mobile_phone()
    {
        return '0'.preg_replace('/\s|\(|\)/', '', $this->entity->mobile_phone);
    }
}