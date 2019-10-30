@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Product Panel')</h3>
    @can('celoteh_create')
    <p>
        <a href="{{ route('admin.celoteh.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('List Product')
            <div class="row">
                <div class="col-xs-12">
                    @include('partials.info') <br>
                </div>
            </div>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($celotehs) > 0 ? 'datatable' : '' }} @can('celoteh_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('celoteh_delete')
                           <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('Image')</th>
                        <th>@lang('Categori Produk')</th>
                        <th>@lang('Nama Produk')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($celotehs) > 0)
                        @foreach ($celotehs as $celoteh)
                            <tr data-entry-id="{{ $celoteh->id }}">
                                @can('celoteh_delete')
                                    <td></td>
                                @endcan

                                <td width="150px"><img width="60%" height="55px" src="{{asset('product_image/'.$celoteh->primary_image)}}"></td>
                                <td>{{ $celoteh->category->name }}</td>
                                <td>{{ $celoteh->name }}</td>
                                <td>
                                    @can('celoteh_view')
                                    <a href="{{ route('admin.celoteh.show',[$celoteh->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('celoteh_edit')
                                    <a href="{{ route('admin.celoteh.edit',[$celoteh->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('celoteh_delete')
                                    <a href="#{{$celoteh->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
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

              @foreach($celotehs as $celoteh)
                <div class="modal fade text-center" id="{{$celoteh->id}}-delete">
                    <div class="modal-dialog" style="margin-top: 8%;">
                      <div class="modal-content">
                      
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title text-dark" style="text-align: center;">??? Apakah anda Yakin ???</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                          <i class="fa fa-exclamation-circle text-center" style="text-align: center; font-size: 140px; color: #ED4337; margin-top: -4%;"></i>
                          <h3 class="text-dark">Konfirmasi Hapus Product dengan nama "<b>{{$celoteh->name}}</b>"?</h3>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <form action="{{route('admin.celoteh.destroy',$celoteh->id)}}" method="post">
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
            window.route_mass_crud_entries_destroy = '{{ route('admin.celoteh.mass_destroy') }}';
        @endcan

    </script>
@endsection