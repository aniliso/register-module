@component('mail::message')
# Sayın Yetkili,

{{ $form->id }} no.lu başvuru formu bilgileri aşağıda sunulmuştur.

@component('mail::table')

# Firma Bilgileri
|          |         |
| :------- | :------ |
| @lang('register::forms.form.reference_no') | {{ $form->reference_no }} |
| @lang('register::forms.form.company') | {{ $form->company }} |
| @lang('register::forms.form.identity_no') | {{ $form->identity_no }} |
| @lang('register::forms.form.signatory') | {{ $form->signatory }} |
| @lang('register::forms.form.email') | {{ $form->email }} |
| @lang('register::forms.form.work_phone') | {{ $form->work_phone }} |
| @lang('register::forms.form.mobile_phone') | {{ $form->mobile_phone }} |

# Teminat Türü
|          |         |
| :------- | :------ |
| @lang('register::forms.form.collateral_id') | {{ mb_strtoupper($form->collateral()->where('id', $form->collateral_id)->first()->title) }} |
@if($form->collateral_id == setting('register::credit-card'))
| @lang('register::forms.form.credit_card.name_surname') | {!! $form->credit_card->name_surname !!} |
| @lang('register::forms.form.credit_card.bank') | {!! $form->credit_card->bank !!} |
| @lang('register::forms.form.credit_card.no') | {!! $form->credit_card->no !!} |
| @lang('register::forms.form.credit_card.end_date') | {!! $form->credit_card->end_date !!} |
| @lang('register::forms.form.credit_card.cv') | {!! $form->credit_card->cv !!} |
| @lang('register::forms.form.credit_card.provision_amount') | {!! number_format($form->credit_card->provision_amount, 2) !!} TL |
| @lang('register::forms.form.credit_card.phone') | {!! $form->credit_card->phone !!} |
| @lang('register::forms.form.credit_card.address') | {!! $form->credit_card->address !!} |
@if(isset($form->vehicles))
# Araçlar
| @lang('register::forms.form.vehicles.plate') | @lang('register::forms.form.vehicles.brand') | @lang('register::forms.form.vehicles.model') | @lang('register::forms.form.vehicles.fuel') | @lang('register::forms.form.vehicles.kit') |
| :------- | :------- | :------ | :------- | :------ |
@foreach($form->vehicles as $vehicle)
| {{ $vehicle->plate }} | {{ $vehicle->brand }} | {{ $vehicle->model }} | {{ $fuelTypes->get($vehicle->fuel) }} | {{ $kitTypes->get($vehicle->kit) }} |
@endforeach
@endif
@endif
@endcomponent

# Teminat/Tüketim
|          |         |
| :------- | :------ |
| @lang('register::forms.form.collateral_amount') | {{ number_format($form->collateral_amount, 2) }} TL |
| @lang('register::forms.form.monthly_consumption') | {{ number_format($form->monthly_consumption, 2) }} TL |
| İskonto Yüzdesi | %{{ $rate['percent'] }} |
| Aylık Tüketim Oranına Göre İndirim | {!! number_format(($rate['percent'] / 100) * $form->monthly_consumption, 2) !!} TL |

@component('mail::footer')
<hr>
{!! setting('theme::company-name') !!}<br>
{!! setting('theme::address') !!}<br>
{{ setting('theme::phone') }}<br>
{{ setting('theme::email') }}
@endcomponent

@endcomponent


