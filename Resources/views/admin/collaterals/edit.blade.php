@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('register::collaterals.title.edit collateral') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.register.collateral.index') }}">{{ trans('register::collaterals.title.collaterals') }}</a></li>
        <li class="active">{{ trans('register::collaterals.title.edit collateral') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.register.collateral.update', $collateral->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-8">
            <div class="nav-tabs-custom">

                <div class="tab-content">

                    <div class="box-body">
                        {!! Form::normalInput('title', trans('register::collaterals.form.title'), $errors, $collateral) !!}

                        {!! Form::normalInput('code', trans('register::collaterals.form.code'), $errors, $collateral) !!}

                        {!! Form::normalTextarea('rates', trans('register::collaterals.form.rates'), $errors, $collateral, ['class'=>'form-control']) !!}
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.register.collateral.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>

                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-body">
                    @mediaMultiple('collateralDocs', $collateral, null, trans('register::collaterals.form.doc'))
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
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.register.collateral.index') ?>" }
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
