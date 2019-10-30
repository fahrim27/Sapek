@extends('layouts.app')

@section('content')

    <h3 class="page-title">@lang('Detail Produk') <small>{!! $celotehs->name !!}</small></h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('View Produk')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('Produk Kategoru')</th>
                            <td>{{ $celotehs->category->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Nama Produk')</th>
                            <td>{{ $celotehs->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Model Produk')</th>
                            @if(empty($celotehs->model))
                             <td>Model Tidak di Isi</td>
                            @else
                             <td>{{ $celotehs->model }}</td>
                            @endif
                        </tr>
                        <tr>
                            <th>@lang('Stok Produk')</th>
                            <td>{{ $celotehs->stock }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Harga Produk')</th>
                            <td>Rp. {{ number_format($celotehs->price, 2, ',','.') }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Jumlah Order')</th>
                            <td>0 Success || 0 Pending</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <img width="100%" height="250px" src="{{asset('product_image/'.$celotehs->primary_image)}}">
                    <br>
                        <div id="carousel-1" class="carousel slide multi-item-carousel" data-ride="carousel">
                          <ol class="carousel-indicators">
                            <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-1" data-slide-to="1"></li>
                            <li data-target="#carousel-1" data-slide-to="2"></li>
                          </ol>
                          <div class="carousel-inner" role="listbox">
                            <div class="item active">
                              <div class="item__third">
                                <img src="{{asset('product_image/'.$celotehs->primary_image)}}" alt="">
                              </div>
                            </div>
                            @foreach($imgPro as $pro)
                            <div class="item">
                              <div class="item__third">
                                <img src="{{asset('product_image/optional/'.$pro->optional_images)}}" alt="">
                              </div>
                            </div>
                            @endforeach
                          </div>
                          <a href="#carousel-1" class="left carousel-control" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
                          <a href="#carousel-1" class="right carousel-control" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                        </div>
                </div>
            </div>

            <p>&nbsp;</p>

            <div class="row">
                <div class="col-md-9">
                    <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($imgPro) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th width="170px">@lang('Image')</th>
                        <th>Update</th>
                        <th>Remove</th>
                    </tr>
                </thead> 
                <tbody>
                    @if (count($imgPro) > 0)
                        @foreach ($imgPro as $img)
                            <tr data-entry-id="{{ $img->id }}">
                                <td></td>
                                <td><img width="50%" height="70px" src="{{asset('product_image/optional/'.$img->optional_images)}}"></td>
                                <td>{!! Form::model($img, ['method' => 'PUT', 'enctype' => 'multipart/form-data', 'route' => ['admin.image.update', $img->id]]) !!}
                                    {!! Form::file('optional_images', ['class' => 'form-control', 'placeholder' => '', 'style' => 'border: none;' ]) !!}
                                    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger', 'style' => 'margin-left: 20px;']) !!}
                                    {!! Form::close() !!}</td>
                                <td>{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Apakah anda yakin mau menghapus foto ini ?")."');",
                                        'route' => ['admin.image.destroy', $img->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-danger')) !!}
                                    {!! Form::close() !!}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
                </div>
                </div>
            </div>  <br><br>

            <a href="{{ route('admin.celoteh.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>

@stop


@section('javascript')
    @parent
    <script>
        $('.multi-item-carousel .item').each(function(){
          var next = $(this).next();
          if (!next.length) next = $(this).siblings(':first');
          next.children(':first-child').clone().appendTo($(this));
        });

        $('.multi-item-carousel .item').each(function(){
          var prev = $(this).prev();
          if (!prev.length) prev = $(this).siblings(':last');
          prev.children(':nth-last-child(2)').clone().prependTo($(this));
        });
    </script>

@stop