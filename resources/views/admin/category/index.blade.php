@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Category Panel')</h3>
    @if(count($categories) < 6)
    @can('category_create')
    <p>
        <a href="{{ route('admin.category.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan
    @else
    <p>
        <button class="btn btn-danger" disabled="disabled">Category Ou Off Limit</button> 
      </p>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('List Category')
            <div class="row">
                <div class="col-xs-12">
                    @include('partials.info') <br>
                </div>
            </div>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($categories) > 0 ? 'datatable' : '' }} @can('category_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('category_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('Nama Category')</th>
                        <th>@lang('Dibuat pada')</th>
                        <th width="14%">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <tr data-entry-id="{{ $category->id }}">
                                @can('category_delete')
                                    <td></td>
                                @endcan

                                <td>{!! $category->name !!}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    @can('category_view')
                                    <a href="{{ route('admin.category.show',[$category->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('category_edit')
                                    <a href="#{{$category->id}}" data-toggle="modal" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('category_delete')
                                    <a href="#{{$category->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>

             @foreach($categories as $category)
                <div class="modal fade text-center" id="{{$category->id}}">
                    <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{route('admin.category.update',$category->id)}}" method="post"
                                      role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <div class="form-group">
                                          <input type="text" name="name" class="form-control" value="{{$category->name}}">
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Perbaharui</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                </div>
              @endforeach

            @foreach($categories as $category)
                <div class="modal fade text-center" id="{{$category->id}}-delete">
                    <div class="modal-dialog" style="margin-top: 6%;">
                      <div class="modal-content">
                      
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title text-dark" style="text-align: center;">Apakah anda yakin ingin Menghapus Kategori <br> "<b style="text-align: center;">{{$category->name}} </b>"???</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                          <i class="fa fa-exclamation-circle text-center" style="text-align: center; font-size: 140px; color: #ED4337; margin-top: -4%;"></i>
                          <p class="text-dark" style="font-size: 22px; font-weight: 600;">Penghapusan pada kategori ini, akan menghapus semua produk yang terdapat di dalamnya!!!</p>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <form action="{{route('admin.category.destroy',$category->id)}}" method="post">
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
        @can('category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.category.mass_destroy') }}';
        @endcan

    </script>
@endsection