<nav class="navbar navbar-toggleable-md navbar-light bg-faded mb-5">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{ url('home') }}">Bank</a>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      @if (Auth::check())
        @if (Auth::user()->type == 'CS')
          @if (Request::is('accounts'))
            <li class="nav-item active">
          @else
            <li class="nav-item">
          @endif
            <a class="nav-link" href="{{ route('accounts') }}">Accounts</a>
          </li>
          @if (Request::is('registercs'))
            <li class="nav-item active">
          @else
            <li class="nav-item">
          @endif
            <a class="nav-link" href="{{ route('addcs') }}">Add a Custmer Services</a>
          </li>
          @if (Request::is('maintenance'))
            <li class="nav-item active">
          @else
            <li class="nav-item">
          @endif
            <a class="nav-link" href="{{ route('maintenance') }}">Account Maintenance</a>
          </li>


        @else
          @if (Request::is('home'))
            <li class="nav-item active">
          @else
            <li class="nav-item">
          @endif
            <a class="nav-link" href="{{ url('home') }}">Home <span class="sr-only">(current)</span></a>
          </li>
          @if (Request::is('transfers'))
            <li class="nav-item active">
          @else
            <li class="nav-item">
          @endif
            <a class="nav-link" href="{{ route('transfers') }}">Funds Transfer</a>
          </li>
          @if (Request::is('payments'))
            <li class="nav-item active">
          @else
            <li class="nav-item">
          @endif
            <a class="nav-link" href="{{ route('payments') }}">Payments</a>
          </li>

          @if (Request::is('maintenance'))
            <li class="nav-item active">
          @else
            <li class="nav-item">
          @endif
            <a class="nav-link" href="{{ route('maintenance') }}">Account Maintenance</a>
          </li>

        @endif


{{-- not logged in --}}


      @endif
    </ul>
    <span class="navbar-text">
      @if (Auth::check())
        <form class="" action="{{ route('logout') }}" method="post">
          {{ csrf_field() }}
            <input type="submit" class="btn btn-sm btn-danger" value="Logout">
        </form>
      @endif
    </span>
  </div>
</nav>
@include('layouts._flash')
