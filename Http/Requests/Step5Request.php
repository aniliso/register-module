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
        $form = request()->session()->get('form');
        $kit  = isset($form->credit_card->cars) ? array_search("Automatic Kart", array_column($form->credit_card->cars, "kit")) !== false ? 'required' : '' : '';

        return [
            'agreement1'       => 'required',
            'agreement2'       => 'required',
            'shipping_address' => "$kit"
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
