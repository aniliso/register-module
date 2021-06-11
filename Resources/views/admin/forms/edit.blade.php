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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_info" data-toggle="tab">Başvuru Bilgileri</a>
                    </li>
                    <li>
                        <a href="#tab_collateral" data-toggle="tab">Teminat Türü</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_info">
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
                    <div class="tab-pane" id="tab_collateral">deneme</div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.register.form.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
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
