<?php

namespace Modules\Register\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class Step1Request extends BaseFormRequest
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
            'company'          => 'required',
            'identity_no'      => 'required|digits_between:10,13',
            'signatory'        => 'required',
            'email'            => 'required|email',
            'work_phone'       => 'required',
            'mobile_phone'     => 'required'
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
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
