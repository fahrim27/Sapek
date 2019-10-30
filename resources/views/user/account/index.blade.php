@extends('layouts.guest')

@section('content')
    @include('partials.guest.header')
    	<br><br><br><br>
   
  @can('profile_view')
   <div class="greyBg">
    <div class="container">
		<div class="wrapper">

        <div class="row top25" >
            <div class="panel itemBox" style="background-color: #fcfcfc;">
                <div class="panel-header"><h2 align="center" style="color: black;">My Account</h2><hr></div>

               
                  <div class="row">
                      <div class="col-xs-12">
                          @include('partials.info') <br>
                      </div>
                  </div>
                

                <div class="panel-body" style="padding-left: 25px; padding-right: 25px;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(isset($link))
                    <div class="myContent">

                      <ul class="nav nav-tabs">
                        @if($link=="profile")
                        <li class="active"><a href="#profile" data-toggle="tab">profile</a></li>
                        <li><a href="#myorders" data-toggle="tab">My orders</a></li>
                        <li><a href="#changepassword" data-toggle="tab">change Password</a></li>

                        @elseif($link=="myorders")
                        <li ><a href="#profile" data-toggle="tab">profile</a></li>
                        <li class="active"><a href="#myorders" data-toggle="tab">My orders</a></li>
                        <li><a href="#changepassword" data-toggle="tab">change Password</a></li>

                        @elseif($link=="changepassword")
                        <li ><a href="#profile" data-toggle="tab">profile</a></li>
                        <li><a href="#myorders" data-toggle="tab">My orders</a></li>
                        <li class="active"><a href="#changepassword" data-toggle="tab">change Password</a></li>
                        @else
                        something else
                        @endif
                      </ul>

                      <div class="tab-content col-md-6">
                        <div id="profile" class="tab-pane fade in active">
                        your {{$link}} data <br>
                        <button type="submit" class="btn btn-primary btn-block"><a href="#{{$prof->id}}" data-target="#{{$prof->id}}" data-toggle="modal">You Have Set Your Profile, try Update here</a></button>
                        </div>
                        <div id="myorders" class="tab-pane fade in" >
                          myorders tab
                        </div>
                        <div id="changepassword" class="tab-pane fade in">
                          changepassword tab
                        </div>
                      </div>

                    </div>
                    @else
                  <div class="myContent">

                    <ul class="nav nav-tabs">

                      <li class="active"><a href="#profile" data-toggle="tab">profile</a></li>
                      <li><a href="#myorders" data-toggle="tab">My orders</a></li>
                      <li><a href="#changepassword" data-toggle="tab">change Password</a></li>

                    </ul>

                    <div class="tab-content">
                      <div id="profile" class="tab-pane fade in active">
                      <h3 style="padding: 30px; text-align: center;">Personal Details</h3>
                      <form action="post" method="{{route('profile.save')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                       
                        <input type="text" name="name" class="form-control"
                         value="Nama User" placeholder="Full Name"/>
                        <br>

                      
                         <input type="text" name="email" class="form-control"
                         value="Email User"
                         readonly style="background-color:#efefef" placeholder="email"/>
                         <br>

                          
                          <input type="text" name="city" class="form-control"
                          placeholder="City"/>
                          <br>
                          
                          
                          <input type="text" name="phone"  class="form-control"
                          placeholder="Phone Number"/>
                          <br>

                           <input type="text"  class="form-control" placeholder="State" name="state">
                          <br>
                          <textarea  class="form-control" rows="4" placeholder="Full Address"
                          name="full_address"></textarea>
                          <br>
                         @if(isset($profile))
                         <input type="submit" class="btn btn-primary btn-block" value="Update">
                         @else
                         <button type="submit" class="btn btn-primary btn-block"><a href="http://localhost:8000/myaccount/profile">You Have Set Your Profile, try Update here</a></button>
                         @endif
                      </form>
                      </div>

                      <div id="myorders" class="tab-pane fade in" style="height:400px; overflow-x:scroll">
                        	<div class="row col-md-12">
                            <table class="table table-striped" id="list">
                              <tr>
                                  <th>Order ID</th>
                                  <th>Keberangkatan</th>
                                  <th>Tujuan</th>
                                  <th>Tanggal Sewa</th>
                                  <th>Detail Penjeputan</th>
                                  <th>Total Tagihan</th>
                                  <th style="text-align: center;">Pembayaran</th>
                              </tr>
                              @foreach ($order as $ordr)
                              <tr>
                                  <td><code>{{ $ordr->id }}</code></td>
                                  <td>{{ $ordr->keberangkatan }}</td>
                                  <td>{{ $ordr->tujuan }}</td>
                                  <td>{{ date('d F Y', strtotime($ordr->tgl_sewa)) }} - {{ date('d F Y', strtotime($ordr->tgl_sampai))}}</td>
                                  <td>{{ ucwords($ordr->alamat_jemputan) }} ({{ $ordr->waktu_jemput }})</td>
                                  <td>Rp. {{ number_format($ordr->amount) }},-</td>
                                  <td>{{ ucfirst($ordr->status) }}</td>
                                  <td style="text-align: center;">
                                      @if ($ordr->status == 'pending')
                                      <button class="btn btn-success btn-sm btn-block" onclick="snap.pay('{{ $ordr->snap_token }}')">Bayar Sekarang</button>

                                     {!! Form::open(array(
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Apakah anda yakin mau membatalkan Orderan ini ?")."');",
                                        'route' => ['order.destroy', $ordr->id])) !!}
                                    {!! Form::submit(trans('Batalkan Orderan'), array('class' => 'btn btn-danger btn-sm btn-block', 'style' => 'margin-top: 10px;')) !!}
                                    {!! Form::close() !!}
                                      @endif
                                  </td>
                              </tr>
                              @endforeach
                              <tr>
                                  {{-- <td colspan="6">{{ $order->links() }}</td> --}}
                              </tr>
                          </table>
                          </div>
                     <?php   /* @foreach(App\Order::where('user_id',Auth::user()->id)->orderBY('created_at','DESC')->get() as $orders)
                            <div class="row">
                            <p class="alert-info col-md-12">{{date('D, d F Y, h:i', strtotime($orders->created_at))}}</p>
                                <div class="col-md-4 col-sm-4 col-xs-4">  
                                    <img src="{{Config::get('app.url')}}/public/img/No_Image_Available.png" width="100px"/>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4"> 
                                <h4 > {{$orders->status}}</h4>
                                  <h5 > $ {{$orders->total}}</h5>
                                </div>
                              <div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:10px">
                              <a href="{{url('orderDetails')}}/{{$orders->id}}" class="btn"><i class="fa fa-list"></i> Order Details</a>
                              <br><br>
                              <a href="{{url('#')}}/{{$orders->id}}" class="btn"><i class="fa fa-map-marker"></i> Track Order</a>
                              </div>
                            </div>
                            <hr>
                      @endforeach */?>
                      </div>

                      <div id="changepassword" class="tab-pane fade in" style="height:400px;">
                            {!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
                            <!-- If no success message in flash session show change password form  -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    @lang('quickadmin.qa_edit')
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 form-group">
                                            {!! Form::label('current_password', 'Current password*', ['class' => 'control-label']) !!}
                                            {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => '']) !!}
                                            <p class="help-block"></p>
                                            @if($errors->has('current_password'))
                                                <p class="help-block">
                                                    {{ $errors->first('current_password') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 form-group">
                                            {!! Form::label('new_password', 'New password*', ['class' => 'control-label']) !!}
                                            {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => '']) !!}
                                            <p class="help-block"></p>
                                            @if($errors->has('new_password'))
                                                <p class="help-block">
                                                    {{ $errors->first('new_password') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 form-group">
                                            {!! Form::label('new_password_confirmation', 'New password confirmation*', ['class' => 'control-label']) !!}
                                            {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}
                                            <p class="help-block"></p>
                                            @if($errors->has('new_password_confirmation'))
                                                <p class="help-block">
                                                    {{ $errors->first('new_password_confirmation') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                       
                      </div>


                    </div>
                  </div>
                  @endif

                </div>
            </div>
        </div>
    </div>
  </div>
</div>

			@foreach($prof as $profile)
                <div class="modal fade" id="{{$profile->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Your Profile Here</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('profile.update',$profile->id)}}" method="post"
                              role='form'>
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <div class="form-group">
                                  <input type="text" name="name" class="form-control"
			                         placeholder="{{Auth::user()->name}}"/> 
			                         <input type="text" name="email" class="form-control"
			                         value="{{Auth::user()->email}}"
			                         readonly style="background-color:#efefef" placeholder="{{Auth::user()->email}}"/>
			                          <input type="text" name="city" class="form-control"
			                          placeholder="{{$profile->city}}" />
			                          <input type="text" name="phone"  class="form-control" placeholder="{{$profile->phone}}"/>
			                           <input type="text"  class="form-control" placeholder="{{$profile->state}}" name="state">
			                          <br>
			                          <textarea  class="form-control" rows="4" placeholder="{{$profile->full_address}}" name="full_address"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </form>
                          </div>
        <!--                  <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div> -->
                        </div>
                      </div>
                    </div>
              @endforeach

  <br>

@endcan
@endsection