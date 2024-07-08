@extends('layouts.app')

@section('form')
<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-sm-12">
            @include('includes.form_error')
        </div>
    </div>
</div>
<?php $companies = \App\Models\Company::all();?>
<form class="pt-3" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <input placeholder="EMAIL" id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    </div>

    <div class="form-group">
        <input placeholder="PASSWORD" id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    </div>

    <div class="form-group">
        <select class="form-control" name="company" id="company">
            @foreach ($companies as $company)
                <option value="{{$company->id}}">{{$company->company_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
            SIGN IN
        </button>
    </div>
    
</form>
<div class="container-fluid my-3 ">
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">
                <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=cefrian.trinchera@bevmi.com"  class="auth-link text-black">Forgot password? Please Contact the IT DEPT.</a>
            </div>
        </div>
    </div>
</div>
@endsection
