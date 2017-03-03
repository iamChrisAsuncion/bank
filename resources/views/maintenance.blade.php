@extends('layouts.app')

@section('content')
  @include('layouts._nav')

<div class="container mt-5 text-center">

    <h3>Account Maintenance</h3>
  <div id="accordion" role="tablist" aria-multiselectable="true">
    <div class="card">
      <div class="card-header" role="tab" id="headingOne">
        <h5 class="mb-0">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Change Email
          </a>
        </h5>
      </div>

      <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
        <div class="card-block">
          <div class="col-md-4 offset-md-4 form-group mt-4">

            <form  action="{{route('email')}}" method="post">
                  {{ csrf_field() }}
              <input type="email" name="email" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}" required>
              <input type="password" name="password" class="form-control mt-1" placeholder="Password" required>
              <input type="submit" value="Change Email"  class="mt-1 btn btn-block btn-primary">

            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" role="tab" id="headingTwo">
        <h5 class="mb-0">
          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Change Password
          </a>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="card-block">
          <div class="col-md-4 offset-md-4">


          <form  action="{{route('passwords')}}" method="post">
            <input type="password" name="old_password" class="form-control mt-1" placeholder="Old Password" required>
            <input id="password" type="password" class="form-control mt-1" name="password" placeholder="New Password" required>
            <input id="password-confirm" type="password" class="form-control mt-1" name="password_confirmation" placeholder="Confirm Password" required>
            <input type="submit" value="Change Password" class="mt-1 btn btn-block btn-primary">
          </form>
                    </div>
        </div>
      </div>
    </div>

  </div>





</div>
@endsection
