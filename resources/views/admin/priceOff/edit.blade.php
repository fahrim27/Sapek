@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Discount')</h3>
    {!! Form::model($priceOffs, ['method' => 'PUT', 'route' => ['admin.list.update', $priceOffs->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('Edit Discount') - <b>{{ $priceOffs->products->name}}</b>
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pro_id', 'Pilih Produk*', ['class' => 'control-label']) !!}
                    {!! Form::select('pro_id', $products, old('pro_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pro_id'))
                        <p class="help-block">
                            {{ $errors->first('pro_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('discount', 'Diskon Produk*', ['class' => 'control-label']) !!}
                    {!! Form::number('discount', old('discount'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('discount'))
                        <p class="help-block">
                            {{ $errors->first('discount') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-5 form-group">
                    {!! Form::label('start_date', 'Tanggal Mulai*', ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('start_date'))
                        <p class="help-block">
                            {{ $errors->first('start_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 text-center"> || </div>
                <div class="col-xs-5 form-group">
                    {!! Form::label('end_date', 'Tanggal Berakhir*', ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_date'))
                        <p class="help-block">
                            {{ $errors->first('end_date') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script>
        $( function() {
            $( '.date' ).datepicker({
                autoclose: true,
                todayHighlight:'TRUE',
                minDate: 1,
                dateFormat: "{{ config('app.date_format_js') }}"
            });
        } );

        

    </script>

@stop