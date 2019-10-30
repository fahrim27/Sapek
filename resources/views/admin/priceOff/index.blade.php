@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Product Discount Panel')</h3>
    @can('celoteh_create')
    <p>
        <a href="{{ route('admin.list.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('List Of Discount Product')
            <div class="row">
                <div class="col-xs-12">
                    @include('partials.info') <br>
                </div>
            </div>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($discountLists) > 0 ? 'datatable' : '' }} @can('celoteh_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('celoteh_delete')
                           <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('Nama Produk')</th>
                        <th>@lang('Kategori')</th>
                        <th>@lang('Diskon')</th>
                        <th>@lang('Harga awal')</th>
                        <th>@lang('Harga Akhir')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($discountLists) > 0)
                        @foreach ($discountLists as $list)
                            <tr data-entry-id="{{ $list->id }}">
                                @can('celoteh_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $list->products->name }}</td>
                                <td>{{ $list->products->category->name }}</td>
                                <td>{{ $list->discount }}</td>
                                <td>{{ $list->products->price }}</td>
                                    <?php
                                        $diskon = $list->discount /100;
                                        $hargaAkhir = $list->products->price - ($list->products->price * $diskon);
                                     ?>
                                <td>{{ $hargaAkhir }}</td>
                                <td>
                                    @can('celoteh_view')
                                    <a href="{{ route('admin.list.show',[$list->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('celoteh_edit')
                                    <a href="{{ route('admin.list.edit',[$list->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('celoteh_delete')
                                    <a href="#{{$list->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>

              @foreach($discountLists as $list)
                <div class="modal fade text-center" id="{{$list->id}}-delete">
                    <div class="modal-dialog" style="margin-top: 8%;">
                      <div class="modal-content">
                      
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title text-dark" style="text-align: center;"> Apakah anda Yakin ???</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                          <i class="fa fa-exclamation-circle text-center" style="text-align: center; font-size: 140px; color: #ED4337; margin-top: -4%;"></i>
                          <h3 class="text-dark">Konfirmasi Hapus Diskon Product Pada Barang <br>"<b class="text-center">{{$list->products->name}}</b>"?</h3>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <form action="{{route('admin.list.destroy',$list->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger" >Hapus</button>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                </div>
              @endforeach

        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('celoteh_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.list.mass_destroy') }}';
        @endcan

    </script>
@endsection