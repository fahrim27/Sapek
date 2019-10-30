@extends('layouts.auth')
@section('title',"GetBuss || Register From")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="numeric" class="form-control" name="phone" value="{{ old('email') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('perusahaan') ? ' has-error' : '' }}">
                            <label for="perusahaan" class="col-md-4 control-label">Nama Perusahaan</label>

                            <div class="col-md-6">
                                <input id="perusahaan" type="text" class="form-control" name="perusahaan" value="{{ old('perusahaan') }}" required>

                                @if ($errors->has('perusahaan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('perusahaan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('img_ktp') ? ' has-error' : '' }}">
                            <label for="img_ktp" class="col-md-4 control-label">KTP Scan</label>

                            <div class="col-md-6">
                                <input id="img_ktp" type="file" class="form-control" name="img_ktp" value="{{ old('img_ktp') }}" required>

                                @if ($errors->has('img_ktp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('img_ktp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('img_usaha') ? ' has-error' : '' }}">
                            <label for="img_usaha" class="col-md-4 control-label">KTP Scan</label>

                            <div class="col-md-6">
                                <input id="img_usaha" type="file" class="form-control" name="img_usaha" value="{{ old('img_usaha') }}" required>

                                @if ($errors->has('img_usaha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('img_usaha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
