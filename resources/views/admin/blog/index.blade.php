@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Blog Panel')</h3>
    @can('blog_create')
    <p>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
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
            <table class="table table-bordered table-striped {{ count($blogs) > 0 ? 'datatable' : '' }} @can('blog_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('blog_delete')
                           <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('Image')</th>
                        <th>@lang('Judul')</th>
                        <th>@lang('Isi Konten')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($blogs) > 0)
                        @foreach ($blogs as $blog)
                            <tr data-entry-id="{{ $blog->id }}">
                                @can('blog_delete')
                                    <td></td>
                                @endcan

                                <td width="120px"><img width="55%" height="55px" src="{{asset('blog_images/'.$blog->image)}}"></td>
                                <td>{{ $blog->title }}</td>
                                <td>{!! str_limit($blog->content, 40) !!}</td>
                                <td>
                                    @can('blog_view')
                                    <a href="{{ route('admin.blog.show',[$blog->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('blog_edit')
                                    <a href="{{ route('admin.blog.edit',[$blog->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('blog_delete')
                                    <a href="#{{$blog->id}}-delete" data-toggle="modal" class="btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
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

            @foreach($blogs as $blog)
                <div class="modal fade text-center" id="{{$blog->id}}-delete">
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
                          <h3 class="text-dark">Konfirmasi Hapus Blog Post dengan judul "<b>{{$blog->title}}</b>"?</h3>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <form action="{{route('admin.blog.destroy',$blog->id)}}" method="post">
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
        @can('blog_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.blog.mass_destroy') }}';
        @endcan

    </script>
@endsection