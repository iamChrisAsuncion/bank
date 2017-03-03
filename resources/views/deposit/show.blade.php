@extends('layouts.app')

@section('content')
  @include('layouts._nav')

<div class="container mt-5 text-center">

  <h1>{{ $user->name }}</h1>
  <p>Account #: {{ str_pad($user->id, 11, 0, STR_PAD_LEFT) }}</p>
  <p>Account type: {{ $user->type }}<span>
    <form action="{{ route('changeType', $user->id) }}" method="post">

      {{ csrf_field() }}
    @if ($user->type == 'Savings')
        <input type="hidden" value="Current" name="type">
    @else
        <input type="hidden" value="Savings" name="type">
    @endif
      <input type="submit" class="btn btn-success btn-sm" value="Change Type">
  </form>
</span></p>
  <h3>Balance: Php {{ $user->balance }}</h3>
    {{ csrf_field() }}
  <div class="row">
    <div class="col-md-4">
      <form action="{{ route('deposit', $user->id) }}" method="post">
            <div class="form-group mt-5">
        <input type="text" name="amount" class="form-control text-center" placeholder="Enter amount">
      </div>
      <div class=" ">
        <input type="submit" value="Deposit" class="btn btn-primary btn-block">
      </div>
        </form>
    </div>


<div class="col-md-4 offset-md-4">
  <form action="{{ route('withdraw', $user->id) }}" method="post">
    {{ csrf_field() }}

    <div class="form-group mt-5">
      <input type="text" name="amount" class="form-control text-center" placeholder="Enter amount">
    </div>
    <div class="">
      <input type="submit" value="Withdraw" class="btn btn-danger btn-block">
    </div>
    </div>
  </form>

  </div>


</div>
@endsection
