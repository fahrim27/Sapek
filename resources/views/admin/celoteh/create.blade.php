@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('New Bus Aded')</h3>
    {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'route' => ['admin.celoteh.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                <div class="col-xs-12">
                     @include('partials.info')
                </div>
            </div> <br>

            <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="cat_id" class="text-dark">Category: </label>
                  <select name="cat_id" class="form-control">
                    <option value="" class="disable selected">pilih kategori</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                  <p class="help-block"></p>
                    @if($errors->has('cat_id'))
                        <p class="help-block">
                            {{ $errors->first('cat_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Nama Barang*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('primary_image', 'Product Image (primary)*', ['class' => 'control-label']) !!}
                    {!! Form::file('primary_image', old('primary_image'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('primary_image'))
                        <p class="help-block">
                            {{ $errors->first('primary_image') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row container">
                {!! Form::label('optional_images[]', 'Product Image (optional)', ['class' => 'control-label']) !!}  
                <div class="col-xs-12 form-group increment">                  
                    <div class="input-group-btn"> 
                        <button class="btn btn-success btn-img" type="button"><i class="fa fa-plus"></i>Add</button>
                    </div>
                    <p class="help-block"></p>
                    <div class="clone hide">
                      <div class="control-group input-group container" style="margin-top:5px">
                            {!! Form::file('optional_images[]', ['class' => 'form-control', 'placeholder' => '', 'style' => 'border: none;' ]) !!}
                            <div class="input-group-btn"> 
                              <button class="btn btn-danger" style="margin-right: 100px;" type="button"><i class="fa fa-remove" ></i> Remove</button>
                            </div>
                      </div>
                    </div>
                    @if($errors->has('optional_image[]'))
                        <p class="help-block">
                            {{ $errors->first('optional_images[]') }}
                        </p>
                    @endif
                </div>
            </div> <br>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('stock', 'Stok Barang*', ['class' => 'control-label']) !!}
                    {!! Form::number('stock', old('stock'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('stock'))
                        <p class="help-block">
                            {{ $errors->first('stock') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('price', 'Harga Barang*', ['class' => 'control-label']) !!}
                    {!! Form::number('price', old('price'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('price'))
                        <p class="help-block">
                            {{ $errors->first('price') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('model', 'Model Barang (Kosongi jika tidak ada)', ['class' => 'control-label']) !!}
                    {!! Form::text('model', old('model'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('model'))
                        <p class="help-block">
                            {{ $errors->first('model') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('descriptions', 'Product Content', ['class' => 'control-label']) !!}
                    {!! Form::textarea('descriptions', old('descriptions'), ['class' => 'form-control', 'id' => 'content', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descriptions'))
                        <p class="help-block">
                            {{ $errors->first('descriptions') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <input type="submit" name="Save" class="btn btn-info">
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        });

        $(document).ready(function() {

          $(".btn-img").click(function(){ 
              var html = $(".clone").html();
              $(".increment").after(html);
          });

          $(".btn-dest").click(function(){ 
              var html = $(".cln").html();
              $(".incrm").after(html);
          });

          $("body").on("click",".btn-danger",function(){ 
              $(this).parents(".control-group").remove();
          });

        });

        var konten = document.getElementById("content");
              CKEDITOR.replace(konten,{
              language:'en-gb',
              filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
              filebrowserUploadMethod: 'form'
            });
        CKEDITOR.config.allowedContent = true;
    </script>

@stop