@extends('layouts.app')

@section('content')
  @include('layouts._nav')

<div class="container">


<table class="table">
  <thead class="thead-primary">
    <tr>
      <th>Account no.</th>
      <th>Name</th>
      <th>Account type</th>
      <th>Balance</th>
      <th>More options</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{ str_pad(Auth::user()->id, 10, 0, STR_PAD_LEFT) }}</th>
      <td>{{ ucwords(strtolower(Auth::user()->name)) }}</td>
      <td>{{ Auth::user()->type }}</td>
      <td>Php {{ Auth::user()->balance }}</td>
      <td><a href="{{ route('transactions') }}">View transactions</a></td>
    </tr>

  </tbody>
</table>

</div>

@endsection
