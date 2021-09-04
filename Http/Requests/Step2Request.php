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
            'vehicles.*.plate'             => trans('register::forms.form.vehicles.plate'),
            'credit_card.agree'            => trans('register::forms.form.credit_card.agree'),
        ];
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
