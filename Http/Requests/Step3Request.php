<?php

namespace Modules\Register\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class Step3Request extends BaseFormRequest
{
    protected $translationsAttributesKey = 'register::forms.form';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'collateral_amount'      => 'required',
            'monthly_consumption'    => 'required'
        ];
    }

    public function attributes()
    {
        return trans('register::forms.form');
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return trans('validation');
    }

    public function translationMessages()
    {
        return [];
    }
}
