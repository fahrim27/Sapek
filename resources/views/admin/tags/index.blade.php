@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Tags Panel')</h3>
    @can('tags_create')
    <p>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

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
            <table class="table table-bordered table-striped {{ count($tags) > 0 ? 'datatable' : '' }} @can('tags_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('tags_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('Nama Tag')</th>
                        <th>@lang('Dibuat pada')</th>
                        <th>@lang('Total Tag di Gunakan')</th>
                        <th width="14%">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($tags) > 0)
                        @foreach ($tags as $tag)
                            <tr data-entry-id="{{ $tag->id }}">
                                @can('category_delete')
                                    <td></td>
                                @endcan

                                <td>{!! $tag->name !!}</td>
                                <td>{{ $tag->created_at }}</td>
                                @if ($tag->blog()->count() > 0)
                                  <td>{{ $tag->blog()->count() }} Post Blog</td>
                                @else
                                  <td>Tag tidak digunakan</td>
                                @endif
                                <td>
                                    @can('tags_view')
                                    <a href="#{{$tag->id}}" data-toggle="modal" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('tags_edit')
                                    <a href="#{{$tag->id}}" data-toggle="modal" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('tags_delete')
                                    <a href="#{{$tag->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                    
                    @foreach($tags as $tag)
                        <div class="modal fade" id="{{$tag->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Tags</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{route('admin.tags.update',$tag->id)}}" method="post"
                                      role='form'>
                                  <div class="modal-body">
                                        {{csrf_field()}}
                                        {{method_field('put')}}
                                        <div class="form-group">
                                          <input type="text" name="name" class="form-control" value="{{$tag->name}}">
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

                    @foreach($tags as $tag)
                      <div class="modal fade text-center" id="{{$tag->id}}-delete">
                          <div class="modal-dialog" style="margin-top: 7%;">
                            <div class="modal-content">
                            
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title text-dark" style="text-align: center;">Apakah anda yakin ???</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                              </div>
                              
                              <!-- Modal body -->
                              <div class="modal-body">
                                <i class="fa fa-exclamation-circle text-center" style="text-align: center; font-size: 140px; color: #ED4337; margin-top: -4%;"></i>
                                <p class="text-dark">Ingin menghapus tags dengan nama <b>"{{ $tag->name }}"</b></b>"?</p>
                              </div>
                              
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <form action="{{route('admin.tags.destroy',$tag->id)}}" method="post">
                                      {{csrf_field()}}
                                      {{method_field('DELETE')}}
                                  <button type="submit" class="btn btn-danger" >Hapus</button>
                                </form>
                              </div>
                              
                            </div>
                          </div>
                      </div>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('tags_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.tags.mass_destroy') }}';
        @endcan

    </script>
@endsection