@extends('layouts.app')

@section('content')
  @include('layouts._nav')

<div class="container mt-5">
<h3>Funds Transfer</h3>
<div class="form-group col-md-4 offset-md-4">
  <form action="{{ route('transfer') }}" method="post">

{{ csrf_field() }}
<div class="mt-1">
  <select class="form-control" name="bank" required>
    <option value="">Select Bank</option>
    <option value="BDO">BDO</option>
    <option value="BPI">BPI</option>
    <option value="Security Bank">Security Bank</option>
      <option value="Bank">Same Bank</option>
  </select>
</div>
<div class="mt-1">
<input type="text" name="account_no" class="form-control" placeholder="Enter the Account number">
</div>
<div class="mt-1">
<input type="text" name="amount" class="form-control" placeholder="Enter amount to be paid">
</div>
<div class="mt-1">
<input type="submit" class="btn btn-primary btn-block" value="Transfer">
  </form>
</div>
</div>
</div>
@endsection
