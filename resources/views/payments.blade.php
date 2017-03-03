@extends('layouts.app')

@section('content')
  @include('layouts._nav')

<div class="container mt-5">
<h3>Payments</h3>
<div class="form-group col-md-4 offset-md-4">
  <form action="{{ route('payment') }}" method="post">

{{ csrf_field() }}
<select class="form-control" name="merchant" required>
  <option value="" default>Select Merchant</option>
  <option value="Meralco">Meralco</option>
  <option value="NAWASA">NAWASA</option>
  <option value="MAYNILAD">MAYNILAD</option>
</select>
<div class="mt-1">
<input type="text" name="amount" class="form-control" placeholder="Enter amount to be paid">
</div>
<div class="mt-1">
<input type="submit" class="btn btn-primary btn-block" value="Pay">
  </form>
</div>
</div>
</div>
@endsection
