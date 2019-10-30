@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.payments.title')</h3>
    @can('payment_create')
    <p>
        {{-- <a href="{{ route('admin.payments.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a> --}}
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($orders) > 0 ? 'datatable' : '' }} ">
                <thead>
                    <tr>
                        
                        <th>Order ID</th>
                        <th>Nama Penyewa</th>
                        <th>Keberangkatan</th>
                        <th>Tujuan</th>
                        <th>Tanggal Sewa</th>
                        <th>Total Biaya</th>
                        <th>Status Pembayaran</th>
                        <th>Moderasi</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($orders) > 0)
                        @foreach ($orders as $order)
                            <tr data-entry-id="{{ $order->id }}">
                                
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->nama }}</td>
                                <td>{{ $order->keberangkatan }}</td>
                                <td>{{ $order->tujuan }}</td>
                                <td>{{ date('d F Y', strtotime($order->tgl_sewa)) }}</td>
                                <td>{{ $order->amount }}</td>
                                @if($order->status == 'pending')
                                <td><span class="label label-danger text-center" style="font-size: 17px;">{{ $order->status }}</span></td>
                                @else
                                <td><a href="{{route('', $order->id)}}"><i class="fa fa-edit pull-center openBtn"></i></a></td>
                                @endif
                                <td><button><a href="#{{$order->id}}-mod" data-toggle="modal"><i class="fa fa-edit pull-center openBtn"></i><small>Moderate</small></a></button></td>
                                <td>
                                    @can('payment_view')
                                    <button><a href="#{{$order->id}}-dtl" data-toggle="modal"><i class="fa fa-info-circle"> </i> <small> Click for Detail</small>  </a>'</button>
                                    @endcan
                                </td>
                            </tr>

                            <div class="modal left fade" id="{{$order->id}}-dtl" >
                              <div class="modal-dialog" style=" width: 100%; height:500px; overflow-y:scroll">
                                <div class="modal-content container">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Order Detail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="text-left" style="padding: 20px;">
                                      <div class="form-group input_fields_wrap" style="padding: 20px;">
                                        <button class="btn btn-info btn-block">Order ID: {{$order->id}}</button> <br><br>
                                        <div class="row">
                                            <div class="col-md-3"> user id:</div>
                                            <div class="col-md-3">{{$order->user_id}}</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> Nama User:</div>
                                            <div class="col-md-3">{{$order->nama}}</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> Bus type:</div>
                                            <div class="col-md-3">{{$order->buses->name}}</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> PO Bus:</div>
                                            <div class="col-md-3">{{$order->buses->poBus->name}}</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> No. Ktp (user):</div>
                                            <div class="col-md-3">{{$order->no_ktp}}</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> No. HP (user):</div>
                                            <div class="col-md-3">{{$order->phone}}</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> Tujuan:</div>
                                            <div class="col-md-3">Dari {{$order->keberangkatan}} - Ke {{$order->tujuan}}</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> Tanggal Sewa</div>
                                            <div class="col-md-3">Dari {{ date('d F Y', strtotime($order->tgl_sewa)) }} - Sampai {{ date('d F Y', strtotime($order->tgl_sampai)) }}</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> Tujuan:</div>
                                            <div class="col-md-3">Dari {{$order->keberangkatan}} - Ke {{$order->tujuan}}</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> Detail Jemputan:</div>
                                            <div class="col-md-3">{{$order->alamat_jemputan}} ({{$order->waktu_jemputan}})</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> Total Biaya:</div>
                                            <div class="col-md-3">Rp. {{$order->amount}}</div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> Status:</div>
                                            <div class="col-md-3"><button class="btn btn-sm btn-info">{{$order->status}}</button></div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-3"> Catatan:</div>
                                            <div class="col-md-6">{!! $order->catatan !!}</div>
                                        </div>
                                    </div>
                                  </div>
                            
                                </div>
                              </div>
                          </div>

                          {{-- Edit layanan modal --}}
                    <div class="modal fade" id="{{$order->id}}-mod" >
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Laayanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          {!! Form::open(['method' => 'post', 'route' => ['update.moderate' ,$order->id]]) !!}
                            {{csrf_field()}}
                            {{method_field('put')}}
                                       <div class="row">
                                          <div class="col-md-4"></div>
                                          <div class="form-group col-md-4">
                                              <lable style="margin-left: 15%;">Approval Status:</lable>
                                              <select name="approve" style="margin-left: 20%;">
                                                <option value="0" @if($order->status==0)selected @endif> Pending
                                                </option>
                                                <option value="1" @if($order->status==1)selected @endif>Approve</option>
                                                <option value="2" @if($order->status==2)selected @endif>Reject</option>
                                                <option value="3" @if($order->status==3)selected @endif>Postponed</option> 
                                              </select>
                                          </div>
                                          <div class="form-group col-md-2">
                                            <button type="submit" class="btn btn-block btn-success" style="margin-top:40px">Update</button>
                                          </div>
                                        </div>
                                        </div>
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    {{-- end edit modal --}}

                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        
    </script>
@endsection