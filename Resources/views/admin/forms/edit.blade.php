@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('register::forms.title.edit form') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.register.form.index') }}">{{ trans('register::forms.title.forms') }}</a></li>
        <li class="active">{{ trans('register::forms.title.edit form') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.register.form.update', $form->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_info" data-toggle="tab">@lang('register::forms.stepper.step-1')</a>
                            </li>
                            <li>
                                <a href="#tab_collateral" data-toggle="tab">@lang('register::forms.stepper.step-2')</a>
                            </li>
                            <li>
                                <a href="#tab_consumption" data-toggle="tab">@lang('register::forms.stepper.step-3')</a>
                            </li>
                            <li>
                                <a href="#tab_files" data-toggle="tab">@lang('register::forms.stepper.step-4')</a>
                            </li>
                            <li>
                                <a href="#tab_results" data-toggle="tab">@lang('register::forms.stepper.step-5')</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_info">
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::normalInput('reference_no', trans('register::forms.form.reference_no'), $errors, $form) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::normalInput('company', trans('register::forms.form.company'), $errors, $form) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::normalInput('identity_no', trans('register::forms.form.identity_no'), $errors, $form) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::normalInput('signatory', trans('register::forms.form.signatory'), $errors, $form) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::normalInput('email', trans('register::forms.form.email'), $errors, $form) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::normalInput('work_phone', trans('register::forms.form.work_phone'), $errors, $form, ['placeholder'=>'(555) 555 55 55']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::normalInput('mobile_phone', trans('register::forms.form.mobile_phone'), $errors, $form, ['placeholder'=>'(555) 555 55 55']) !!}
                                    </div>
                                </div>

                                {!! Form::normalTextarea('shipping_address', trans('register::forms.form.shipping_address'), $errors, $form, ['class'=>'form-control', 'rows'=>4]) !!}
                            </div>
                            <div class="tab-pane" id="tab_collateral">
                                <div class="form__group">
                                    <div class="form__radio-group" v-for="(collateral, index) in collateral_types" style="display: inline-block; margin-right: 20px;">
                                        <input v-model="collateral_id" type="radio" name="collateral_id" class="form__radio-input"
                                               :id="'collateral-' + collateral.id" :value="collateral.id">
                                        <label :for="'collateral-' + collateral.id " class="form__radio-label">
                                            <span class="form__radio-button"></span>
                                            @{{ collateral.title }}
                                        </label>
                                    </div>
                                </div>

                                @if($errors->first('collateral_id'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('collateral_id') }}
                                    </div>
                                @endif

                                <transition name="slide-fade">
                                    <fieldset v-if="collateral_id == credit_card">
                                        <legend>Kredi Kartı Bilgileri</legend>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::arrayInput('credit_card[name_surname]', trans('register::forms.form.credit_card.name_surname'), $errors, $form) !!}
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::arrayInput('credit_card[bank]', trans('register::forms.form.credit_card.bank'), $errors, $form) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::arrayInput('credit_card[no]', trans('register::forms.form.credit_card.no'), $errors, $form, ['id'=>'credit_card_no']) !!}
                                            </div>
                                            <div class="col-md-3">
                                                {!! Form::arrayInput('credit_card[end_date]', trans('register::forms.form.credit_card.end_date'), $errors, $form, ['id'=>'end_date']) !!}
                                            </div>
                                            <div class="col-md-3">
                                                {!! Form::arrayInput('credit_card[cv]', trans('register::forms.form.credit_card.cv'), $errors, $form, ['id'=>'cvv']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::arrayInputGroup('credit_card[provision_amount]', trans('register::forms.form.credit_card.provision_amount'), $errors, $form, ['id'=>'provision_amount', 'style'=>'text-align:right;'], 'TL') !!}
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::arrayInput('credit_card[phone]', trans('register::forms.form.credit_card.phone'), $errors, $form, ['id'=>'phone']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! Form::arrayInput('credit_card[address]', trans('register::forms.form.credit_card.address'), $errors, $form, ['class'=>'form-control', 'rows'=>4]) !!}
                                            </div>
                                        </div>
                                    </fieldset>
                                </transition>

                                <transition name="slide-fade">
                                    <fieldset v-if="collateral_id.length !== 0">
                                        <legend>Araç Bilgisi</legend>
                                        <template v-for="(vehicle, key) in vehicles">
                                            <div class="credit_card-cars">
                                                <div>
                                                    <div class="form-group @if($errors->first('vehicles.*.plate')) has-error @endif">
                                                        <label for="plate"
                                                               v-if="key == 0">@lang('register::forms.form.vehicles.plate')</label>
                                                        <input id="plate" :name="'vehicles['+key+'][plate]'"
                                                               placeholder="@lang('register::forms.form.vehicles.plate')"
                                                               class="form-control input-sm" v-model="vehicle.plate"/>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group @if($errors->first('vehicles.*.brand')) has-error @endif">
                                                        <label for="brand"
                                                               v-if="key == 0">@lang('register::forms.form.vehicles.brand')</label>
                                                        <input id="brand" :name="'vehicles['+key+'][brand]'"
                                                               placeholder="@lang('register::forms.form.vehicles.brand')"
                                                               class="form-control input-sm" v-model="vehicle.brand"/>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group @if($errors->first('vehicles.*.model')) has-error @endif">
                                                        <label for="model"
                                                               v-if="key == 0">@lang('register::forms.form.vehicles.model')</label>
                                                        <input id="brand" :name="'vehicles['+key+'][model]'"
                                                               placeholder="@lang('register::forms.form.vehicles.model')"
                                                               class="form-control input-sm" v-model="vehicle.model"/>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group @if($errors->first('vehicles.*.fuel')) has-error @endif">
                                                        <label for="fuel"
                                                               v-if="key == 0">@lang('register::forms.form.vehicles.fuel')</label>
                                                        <select id="fuel" :name="'vehicles['+key+'][fuel]'"
                                                                class="form-control" v-model="vehicle.fuel">
                                                            <option v-for="(fuel, index) in fuels" :value="index">@{{ fuel }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group @if($errors->first('vehicles.*.kit')) has-error @endif">
                                                        <label for="kit"
                                                               v-if="key == 0">@lang('register::forms.form.vehicles.kit')</label>
                                                        <select id="kit" :name="'vehicles['+key+'][kit]'"
                                                                class="form-control" v-model="vehicle.kit">
                                                            <option v-for="(kit, index) in kits" :value="index">@{{ kit }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label v-if="key == 0">&nbsp;</label>
                                                    <div class="form-group" style="padding: 10px">
                                                        <a class="btn-floating"
                                                           v-on:click="addRow(key, 'vehicles')" v-if="vehicles.length < 20">
                                                            <i class="fa fa-plus"></i></a>
                                                        <a class="btn-floating"
                                                           v-on:click="removeRow(key, 'vehicles')" v-if="vehicles.length > 1">
                                                            <i class="fa fa-minus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </fieldset>
                                </transition>

                                <div class="row" v-if="collateral_id == credit_card">
                                    <div class="col-md-12">
                                        Kullanım bedellerini provizyon tutarı üzerinden yukarıda belirttiğim Kredi Kartı hesabıma
                                        borç kaydediniz. Şahsi bilgileriniz, (kredi kartı, adres, e-mail, telefon veya müşteri
                                        numarası vb.) bu bilgiler, sizin haberiniz veya onayınız olmadan ya da yasal yükümlülük
                                        altında bulunmadığı sürece 3. şahıslara kesinlikle verilmeyecektir. Bu bilgiler, en yüksek
                                        güvenlik ve gizlilik standartlarımızla korunacaktır. Bu sorumluluk firmamız tarafından,
                                        yerine getirilemediği takdirde bütün sorumluğu kayıtsız şartsız kabul etmektedir.
                                        <div class="checkbox" style="padding-left: 20px;">
                                            <label class="form-check @if($errors->first('credit_card.agree')) has-error @endif">
                                                <input name="credit_card[agree]" type="checkbox"
                                                       value="1" {{ @$form->credit_card->agree ? 'checked="checked"' : '' }}> Onay
                                                Bilgisi (Yukarıda belirttiğim araç plakalarının alımlarını yukarıda belirtmiş
                                                olduğum kredi kartından tahsil ediniz. Bilginize sunulur.)
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_consumption">
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::normalInputGroup('collateral_amount', trans('register::forms.form.collateral_amount'), $errors, $form, ['style'=>'text-align:right;'], 'TL') !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::normalInputGroup('monthly_consumption', trans('register::forms.form.monthly_consumption'), $errors, $form, ['style'=>'text-align:right;', 'v-on:keydown' => 'onPageDown', 'v-on:change' => 'onPageDown', 'v-model'=>'monthly_consumption'], 'TL') !!}
                                    </div>
                                </div>

                                <transition name="slide-fade">
                                    <div class="row" v-if="percent && price">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <th style="width: 25%;">İskonto Yüzdesi</th>
                                                    <td>: @{{ percent }}</td>
                                                    <th style="width: 25%;">Aylık Tüketim Oranına Göre İndirim</th>
                                                    <td>: @{{ price }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </transition>

                                <transition name="slide-fade">
                                    <div class="loading" v-if="loading == false">
                                        Oranlar Yükleniyor...
                                    </div>
                                </transition>
                            </div>
                            <div class="tab-pane" id="tab_files">
                                @if(isset($form->files))
                                    <div class="table-responsive">
                                        <table class="table table-responsive">
                                            <tr>
                                                <th style="width: 25%;">Belgeler</th>
                                                <td>
                                                    @foreach($form->files as $file)
                                                        <a href="{{ url('assets/register/'.$file->name) }}">{{ $file->name }}</a><br/>
                                                    @endforeach

                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="tab_results">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th style="width: 25%;">@lang('register::forms.form.reference_no')</th>
                                            <td>: {{ $form->reference_no }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <caption><h5 class="theme-txt-color">Başvuru Bilgileri</h5></caption>
                                        <tr>
                                            <th style="width: 25%">@lang('register::forms.form.company')</th>
                                            <td>: {{ $form->company }}</td>
                                            <th>@lang('register::forms.form.identity_no') :</th>
                                            <td>: {{ $form->identity_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('register::forms.form.signatory') :</th>
                                            <td>: {{ $form->signatory }}</td>
                                            <th>@lang('register::forms.form.email') :</th>
                                            <td>: {{ $form->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('register::forms.form.work_phone') :</th>
                                            <td>: {{ $form->work_phone }}</td>
                                            <th>@lang('register::forms.form.mobile_phone') :</th>
                                            <td>: {{ $form->mobile_phone }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <caption><h5 class="theme-txt-color">Teminat Türü</h5></caption>
                                        <tr>
                                            <th style="width: 25%;">@lang('register::forms.form.collateral_id')</th>
                                            <td>: <strong>{{ mb_strtoupper($form->collateral()->where('id', $form->collateral_id)->first()->title) }}</strong></td>
                                        </tr>
                                        @if($form->collateral_id == setting('register::credit-card'))
                                            <tr>
                                                <th>@lang('register::forms.form.credit_card.name_surname')</th>
                                                <td>: {!! $form->credit_card->name_surname !!}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('register::forms.form.credit_card.bank')</th>
                                                <td>: {!! $form->credit_card->bank !!}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('register::forms.form.credit_card.no')</th>
                                                <td>: {!! str_pad(substr($form->credit_card->no, -7), strlen($form->credit_card->no), '*', STR_PAD_LEFT); !!}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('register::forms.form.credit_card.end_date')</th>
                                                <td>: {!! $form->credit_card->end_date !!}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('register::forms.form.credit_card.cv')</th>
                                                <td>: {!! $form->credit_card->cv !!}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('register::forms.form.credit_card.provision_amount')</th>
                                                <td>: {!! number_format($form->credit_card->provision_amount, 2) !!} TL</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('register::forms.form.credit_card.phone')</th>
                                                <td>: {!! $form->credit_card->phone !!}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('register::forms.form.credit_card.address')</th>
                                                <td>: {!! $form->credit_card->address !!}</td>
                                            </tr>
                                            @if(isset($form->vehicles))
                                                <tr>
                                                    <th>@lang('register::forms.form.vehicles.vehicles')</th>
                                                    <td>
                                                        @foreach($form->vehicles as $vehicle)
                                                            <div style="display: inline-flex;">
                                                                <div style="padding: 10px 20px" class="thumbnail">
                                                                    <h4>{{ $vehicle->plate }}</h4>
                                                                    <p>
                                                                        {{ $vehicle->brand.' '.$vehicle->model }}<br/>
                                                                        {{ $fuelTypes->get($vehicle->fuel) }}<br/>
                                                                        {{ $kitTypes->get($vehicle->kit) }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-responsive">
                                        <caption><h5 class="theme-txt-color">Teminat/Tüketim</h5></caption>
                                        <tr>
                                            <th style="width: 25%;">@lang('register::forms.form.collateral_amount')</th>
                                            <td>: {{ number_format($form->collateral_amount, 2) }} TL</td>
                                            <th style="width: 25%;">@lang('register::forms.form.monthly_consumption')</th>
                                            <td>: {{ number_format($form->monthly_consumption, 2) }} TL</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 25%;">İskonto Yüzdesi</th>
                                            <td>: %{{ $rate['percent'] }}</td>
                                            <th style="width: 25%;">Aylık Tüketim Oranına Göre İndirim</th>
                                            <td>: {!! number_format(($rate['percent'] / 100) * $form->monthly_consumption, 2) !!} TL</td>
                                        </tr>
                                        @if(isset($rate['file']))
                                            <tr>
                                                <th style="width: 25%;">Teminat Formları</th>
                                                <td>
                                                    @if(is_array($rate['file']))
                                                        @foreach($rate['file'] as $file)
                                                            {!! Html::link(url($file['path']), $file['filename']) !!}<br/>
                                                        @endforeach
                                                    @else
                                                        {!! Html::link(url($rate['file']['path']), $rate['file']['filename']) !!}
                                                    @endif
                                                </td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>

                                @if(isset($form->files))
                                    <div class="table-responsive">
                                        <table class="table table-responsive">
                                            <caption><h5 class="theme-txt-color">Başvuru Belgeleri</h5></caption>
                                            <tr>
                                                <th style="width: 25%;">Belgeler</th>
                                                <td>
                                                    @foreach($form->files as $file)
                                                        <a href="{{ url('assets/register/'.$file->name) }}">{{ $file->name }}</a><br/>
                                                    @endforeach

                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif

                                @if(isset($form->vehicles))
                                    @if(array_search("1", array_column($form->vehicles, "kit")) !== false)
                                        {!! Form::normalTextarea('shipping_address', trans('register::forms.form.shipping_address'), $errors, $form, ['class'=>'form-control', 'rows'=>4]) !!}
                                    @endif
                                @endif

                                <div class="checkbox" style="margin-left: 20px;">
                                    <label class="form-check @if($errors->first('agreement1')) has-error @endif">
                                        <input name="agreement1" type="checkbox" value="1" {{ @$form->agreement1 || old('agreement1') == 1 ? 'checked="checked"' : '' }}> @page('aslanlar-petrol-kisisel-verilerin-korunmasi-ve-islenmesi-proseduru', 'link')  sayfamızda bulunan "KVKK PROSEDÜRÜ" nü okudum ve onaylıyorum.
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="checkbox" style="margin-left: 20px;">
                                    <label class="form-check @if($errors->first('agreement2')) has-error @endif">
                                        <input name="agreement2" type="checkbox" value="1" {{ @$form->agreement2 || old('agreement2') == 1 ? 'checked="checked"' : '' }}> @page('musteri-aydinlatma-metni', 'link')  sayfamızda bulunan "MÜŞTERİ AYDINLATMA METNİ" ve "TTS MÜŞTERİ AYDINLATMA METNİ" 'ni okudum ve onaylıyorum.
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                                <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                                <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.register.form.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                            </div>
                        </div>
                    </div> {{-- end nav-tabs-custom --}}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script src="{{ Module::asset('register:js/vue.min.js') }}"></script>
    <script src="{{ Module::asset('register:js/axios.min.js') }}"></script>
    <script src="{{ Module::asset('register:js/jquery.mask.min.js') }}"></script>
    <script>
        new Vue({
            el: '#tab_collateral',
            data: {
                collateral_id: '{{ old('collateral_id', $form->collateral_id) }}',
                credit_card: '{{ setting('register::credit-card') }}',
                collateral_types: {!! $collateralTypes !!},
                vehicles: {!! old('vehicles', @$form->vehicles) ? json_encode(old('vehicles', @$form->vehicles)) : "[{ plate:'', brand: '', model: '', fuel: '1', kit: '1', }]" !!},
                fuels: {!! $fuelTypes->toJson() !!},
                kits: {!! $kitTypes->toJson() !!}
            },
            methods: {
                addRow: function (index, id) {
                    this.vehicles.splice(index + 1, 0, {});
                    this.vehicles[index + 1].fuel = '1';
                    this.vehicles[index + 1].kit = '1';
                },
                removeRow: function (index, id) {
                    this.vehicles.splice(index, 1);
                },
                collateralUpdate: function (index) {
                    this.collateral_code = this.collateral_types[index].code;
                }
            }
        });
        new Vue({
            el: '#tab_consumption',
            data: {
                monthly_consumption: '{{ old('monthly_consumption', @$form->monthly_consumption) }}',
                timeout: null,
                percent: null,
                price: null,
                loading: false
            },
            mounted() {
                this.onPageDown();
            },
            methods: {
                onPageDown: function() {
                    clearTimeout(this.timeout);
                    this.percent = null;
                    this.price = null;
                    this.loading = false;
                    if( this.monthly_consumption > 0) {
                        this.timeout = setTimeout(()=>{
                            axios.post('{{ route('admin.register.form.rates') }}', {
                                monthly_consumption: this.monthly_consumption,
                                form_id: {{ $form->id }}
                            })
                                .then(response=>{
                                    this.percent = '%' + response.data.percent;
                                    this.price = response.data.price + ' TL';
                                    this.loading = true;
                                })
                                .catch(function (error){
                                    console.log(error);
                                });
                        }, 800);
                    }
                }
            }
        });
    </script>
    <style>
        .slide-fade-enter-active {
            transition: all .3s ease;
        }

        .slide-fade-leave-active {
            transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
        }

        .slide-fade-enter, .slide-fade-leave-to
            /* .slide-fade-leave-active below version 2.1.8 */
        {
            transform: translateX(10px);
            opacity: 0;
        }
        .credit_card-cars {
            display: flex;
            flex-wrap: wrap;
        }
        .credit_card-cars div:first-child {
            padding-left: 0;
        }
        .credit_card-cars div:last-child {
            padding-right: 0;
        }
        .credit_card-cars div {
            padding: 0 5px;
            flex-direction: row;
        }
        @media screen and (max-width: 800px) {
            .credit_card-cars div {
                flex-direction: column;
            }
        }
    </style>
    <!-- Mask -->
    <script>
        $(document).ready(function(){
            $('#work_phone').mask('(000) 000 00 00');
            $('#mobile_phone').mask('(000) 000 00 00');

            $('#credit_card_no').mask('0000 0000 0000 0000');
            $('#end_date').mask('00/0000', {placeholder: "__/____"});
            $('#cvv').mask('000');
            $('#provision_amount').mask('000000000000000', {reverse: true});
            $('#phone').mask('(000) 000 00 00');

            $('#collateral_amount').mask('000000000000000', {reverse: true});
            $('#monthly_consumption').mask('000000000000000', {reverse: true});
        });
    </script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.register.form.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
