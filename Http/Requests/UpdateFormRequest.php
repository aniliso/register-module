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
            'vehicles.*.plate'             => "required_with:collateral_id",
            'vehicles.*.brand'             => 'required_with:collateral_id',
            'vehicles.*.model'             => 'required_with:collateral_id',
            'vehicles.*.fuel'              => 'required_with:collateral_id',
            'vehicles.*.kit'               => 'required_with:collateral_id',

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
