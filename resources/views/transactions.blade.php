@extends('layouts.app')

@section('content')
  @include('layouts._nav')

<div class="container-fluid mx-1 mt-5">
  <table class="table">
    <thead class="thead-primary">
      <tr>
        <th>Date</th>
        <th>Transaction Type</th>
        <th>Refrence no.</th>
        <th>Remarks</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Balance</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($transactions as $transaction)

      <tr>
        <td>{{ $transaction->created_at }}</td>
        <td>{{ $transaction->type }}</td>
        <th >{{ str_pad($transaction->id, 11, 0, STR_PAD_LEFT) }}</th>
        <td>{{ $transaction->remarks }}</td>
        <td>
        @if ($transaction->debit != 0)
          Php  {{ $transaction->debit }}
        @endif

        </td>
        <td>
        @if ($transaction->credit != 0)
          Php  {{ $transaction->credit }}
        @endif

        </td>
        <td>Php {{ $transaction->balance }}</td>

      </tr>

    @endforeach
    </tbody>
  </table>
{{ $transactions->links() }}
</div>
@endsection
