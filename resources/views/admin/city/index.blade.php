@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Kota Destinasi Panel')</h3>
    @can('city_create')
    <p>
        <a href="{{ route('admin.city.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
            <div class="row">
                <div class="col-xs-12">
                    @include('partials.info') <br>
                </div>
            </div>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($cities) > 0 ? 'datatable' : '' }} @can('city_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('city_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('Kota Destinasi Tersedia')</th>
                        <th>@lang('Provinsi (Null)')</th>
                        <th>@lang('Kode Pos (Null)')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($cities) > 0)
                        @foreach ($cities as $city)
                            <tr data-entry-id="{{ $city->id }}">
                                @can('city_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $city->kota }}</td>
                                <td>{{ $city->provinsi }}</td>
                                <td>{{ $city->kode_pos }}</td>
                                <td>
                                    @can('city_view')
                                    <a href="{{ route('admin.city.show',[$city->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('city_edit')
                                    <a href="{{ route('admin.city.edit',[$city->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('city_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Apakah anda yakin mau menghapus Kota Layanan".$city->kota. "?")."');",
                                        'route' => ['admin.city.destroy', $city->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
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
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('bus_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.city.mass_destroy') }}';
        @endcan

    </script>
@endsection