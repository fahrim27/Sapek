@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('New City Location Added')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.city.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('kota', 'Kota Destinasi (layanan)*', ['class' => 'control-label']) !!}
                    {!! Form::text('kota', old('kota'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('kota'))
                        <p class="help-block">
                            {{ $errors->first('kota') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('provinsi', 'Provinsi (opsional)', ['class' => 'control-label']) !!}
                    {!! Form::text('provinsi', old('provinsi'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('provinsi'))
                        <p class="help-block">
                            {{ $errors->first('provinsi') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('kode_pos', 'Kode Pos (opsional)', ['class' => 'control-label']) !!}
                    {!! Form::text('kode_pos', old('kode_pos'), ['class' => 'form-control', 'placeholder' => '' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('kode_pos'))
                        <p class="help-block">
                            {{ $errors->first('kode_pos') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop