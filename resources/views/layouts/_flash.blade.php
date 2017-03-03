<div class="container">
@if(Session::has('Failed'))
<div class="alert alert-warning" role="alert">
  {{ session('Failed') }}
</div>
@endif
@if(Session::has('Success'))
<div class="alert alert-success" role="alert">
  {{ session('Success') }}
</div>
@endif
@if($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
      @foreach($errors->all() as $error)
          {{ $error }}<br>
      @endforeach
  </div>
@endif
</div>
