<?php

namespace Modules\Register\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class Step5Request extends BaseFormRequest
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
            'agreement1'    => 'required',
            'agreement2'    => 'required'
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
