@extends('layouts.app')

@section('content')
    @include('layouts._nav')
<div class="container">
        <div class="col-md-4 offset-md-4 mt-5">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">E-Mail Address</label>


                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="control-label">Confirm Password</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>


                        <div class="form-group row">
                              <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                              </div>
                              <div class="col-md-6">
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    Already registered?
                                </a>
                              </div>
                        </div>
                    </form>

            </div>

</div>
@endsection
