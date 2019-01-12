@extends('components.master')

@section('title','login')

@section('content')
	<div class="card">
        <div class="card-header font-weight-bold">Login</div>

        <div class="card-body">
            <form method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label text-md-right font-weight-bold">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <label>
                            <input type="checkbox" name="remember" id="remember" class="mr-1">Remember Me
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary py-2 px-4">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop