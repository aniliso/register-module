<?php

namespace Modules\Register\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class Step2Request extends BaseFormRequest
{
    protected $translationsAttributesKey = 'register::forms.form';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = setting('register::credit-card');

        return [
            'collateral_id'                 => 'required',
            'credit_card.name_surname'      => "required_if:collateral_id,==,$id",
            'credit_card.bank'              => "required_if:collateral_id,==,$id",
            'credit_card.address'           => "required_if:collateral_id,==,$id",
            'credit_card.no'                => "required_if:collateral_id,==,$id",
            'credit_card.end_date'          => "required_if:collateral_id,==,$id",
            'credit_card.cv'                => "required_if:collateral_id,==,$id",
            'credit_card.provision_amount'  => "required_if:collateral_id,==,$id",
            'credit_card.phone'             => "required_if:collateral_id,==,$id",
            'credit_card.agree'             => "required_if:collateral_id,==,$id",
            'credit_card.cars.*.plate'      => "required_if:collateral_id,==,$id",
            'credit_card.cars.*.brand'      => 'required_with:credit_card.cars.*.plate',
            'credit_card.cars.*.model'      => 'required_with:credit_card.cars.*.plate',
            'credit_card.cars.*.department' => 'required_with:credit_card.cars.*.plate',
            'credit_card.cars.*.fuel'       => 'required_with:credit_card.cars.*.plate',
            'credit_card.cars.*.kit'        => 'required_with:credit_card.cars.*.plate',
        ];
    }

    public function attributes()
    {
        return [
            'collateral_id'                => trans('register::forms.form.collateral_id'),
            'credit_card.name_surname'     => trans('register::forms.form.credit_card.name_surname'),
            'credit_card.bank'             => trans('register::forms.form.credit_card.bank'),
            'credit_card.address'          => trans('register::forms.form.credit_card.address'),
            'credit_card.no'               => trans('register::forms.form.credit_card.no'),
            'credit_card.end_date'         => trans('register::forms.form.credit_card.end_date'),
            'credit_card.cv'               => trans('register::forms.form.credit_card.cv'),
            'credit_card.provision_amount' => trans('register::forms.form.credit_card.provision_amount'),
            'credit_card.phone'            => trans('register::forms.form.credit_card.phone'),
            'credit_card.cars.*.plate'     => trans('register::forms.form.credit_card.cars_plate'),
            'credit_card.agree'            => trans('register::forms.form.credit_card.agree'),
        ];
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
