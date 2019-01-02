@extends('theme.login')
@section('title', 'CALL-Q LOGIN')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" id="tilte-call-q">
                    </h3>
                </div>
                <div class="panel-body">

@section('content') @if(session()->has('message'))
                    <div class="alert alert-success col-sm-12 col-md-offset-5">
                        <a href="#" class="close" data-dismiss="alert">&times;</a> {{ session()->get('message') }}
                    </div>
                    @endif @if ($errors->any() && (!$errors->has('email')) && (!$errors->has('password')))
                    <div class="alert alert-danger">
                        <ul>
                            <a href="#" class="close" data-dismiss="alert">&times;</a> @foreach ($errors->all() as $error)
                            <li>
                                <p>{{$error }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ url('/login') }}" method="post" class="pt-3 register-form" id="form_register" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail">Company ID</label>
                            <input type="text" name="CompanyId" id="CompanyId" placeholder="Company Id" class="form-control">                            @if ($errors->has('email'))
                            <span class="error1 err">{{ $errors->first('CompanyID') }}</span> @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input type="Password" name="Password" id="Password" placeholder="Password" class="form-control">                            @if ($errors->has('password'))
                            <span class="error2 err">{{ $errors->first('Password') }}</span> @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Personal Code</label>
                            <input type="Password" name="PersonalCode" id="PersonalCode" placeholder="PersonalCode" class="form-control">                            @if ($errors->has('password'))
                            <span class="error2 err">{{ $errors->first('PersonalCode') }}</span> @endif
                        </div>
                        <div class="my-3">
                            <input type="submit" name="LOGIN" value="Sign In" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                style="background:#2b90dc;border-color: #2b90dc;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('After_Script')
@include('comman.plugins')
<script src="{{ asset('js/validation/login-validation.js') }}"></script>
<style>
  body {
        background-image: url(images/loginbg2.jpg);
        background-repeat: round;
    }
    .login-panel .panel-heading{
     background-color: #62bae4 !important;
    border-color: #62bae4 !important;
    color: white!important;
    }
    .login-panel .panel-body{
        background: #f7f7f7;
    }
</style>

@stop