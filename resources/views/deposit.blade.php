@extends('layouts.app')

@section('content')
  @include('layouts._nav')

<div class="container mt-5">
  <form action="{{ route('accountsearch') }}" method="post">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-4 form-group offset-md-3">
        <input type="search" name="search" class="form-control" placeholder="Enter account number">
      </div>
      <div class="col-md-2">
        <input type="submit" value="Search" class="btn btn-primary btn-block">
      </div>
    </div>
  </form>

  <table class="table table-hover">
    <thead class="thead-default">
      <tr>
        <th>Account</th>
        <th>Name</th>
        <th>Type</th>
        <th>Balance</th>
        <th>Created</th>
      </tr>
    </thead>
    <tbody>
      @if ($users->count())
  @foreach ($users as $user)



      <tr onclick="document.location = '{{ route('deposit.show', $user->id) }}'">
        <td>{{ str_pad($user->id, 11, 0, STR_PAD_LEFT) }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->type }}</td>
        <td>Php {{ $user->balance }}</td>
        <td>{{ $user->created_at }}</td>
      </tr>
  @endforeach
  @else
    <tr>
      <td>
    No matches found
  </td>
  </tr>
  @endif
    </tbody>
  </table>

</div>
@endsection
