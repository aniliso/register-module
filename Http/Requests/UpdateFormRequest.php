<?php

namespace Modules\Register\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateFormRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'register::forms.form';

    public function rules()
    {
        $id = setting('register::credit-card');

        return [
            'company'      => 'required',
            'identity_no'  => 'required|digits_between:10,13',
            'signatory'    => 'required',
            'email'        => 'required|email',
            'work_phone'   => 'required',
            'mobile_phone' => 'required',

            'collateral_id'                => 'required',
            'credit_card.name_surname'     => "required_if:collateral_id,==,$id",
            'credit_card.bank'             => "required_if:collateral_id,==,$id",
            'credit_card.address'          => "required_if:collateral_id,==,$id",
            'credit_card.no'               => "required_if:collateral_id,==,$id",
            'credit_card.end_date'         => "required_if:collateral_id,==,$id",
            'credit_card.cv'               => "required_if:collateral_id,==,$id",
            'credit_card.provision_amount' => "required_if:collateral_id,==,$id",
            'credit_card.phone'            => "required_if:collateral_id,==,$id",
            'credit_card.agree'            => "required_if:collateral_id,==,$id",
            'credit_card.cars.*.plate'     => "required_if:collateral_id,==,$id",
            'credit_card.cars.*.brand'     => 'required_with:credit_card.cars.*.plate',
            'credit_card.cars.*.model'     => 'required_with:credit_card.cars.*.plate',
            'credit_card.cars.*.fuel'      => 'required_with:credit_card.cars.*.plate',
            'credit_card.cars.*.kit'       => 'required_with:credit_card.cars.*.plate',

            'collateral_amount'   => 'required',
            'monthly_consumption' => 'required'
        ];
    }

    public function attributes()
    {
        return trans('register::forms.form');
    }

    public function translationRules()
    {
        return [];
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
