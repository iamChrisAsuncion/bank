@extends('layouts.app')

@section('content')
  @include('layouts._nav')
<div class="container">
<div class="col-md-2 offset-md-10 mt-5">
  <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
</div>
        <div class="col-md-4 offset-md-4 mt-5">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                        </div>

                        <div class="form-group row">
                              <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                              </div>
                              <div class="col-md-6">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                              </div>
                        </div>
                    </form>

            </div>
        </div>


@endsection
