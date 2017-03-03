<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\User;
use Auth;

class PagesController extends Controller
{
  public function addcs() {
    return view('auth.registercs');
  }
  public function maintenance() {
    return view('maintenance');
  }
   public function payments() {
     return view('payments');
   }
   public function transfers() {
     return view('transfers');
   }

   public function show($id) {
     $user = User::find($id);
     return view('deposit.show')->withUser($user);
   }
   public function transactions() {

     $transactions = Transaction::where('user_id',Auth::user()->id)
     ->orderBy('created_at', 'desc')
     ->paginate(10);
     return view('transactions')->withTransactions($transactions);
   }



   public function deposits() {

     $users = User::where('type', '=', 'Savings')
     ->orWhere('type', '=', 'Current')
     ->orderBy('created_at', 'desc')
     ->paginate(10);
     return view('deposit')->withUsers($users);
   }
   public function accountsearch(Request $request) {

     $users = User::where('id', 'LIKE', $request->search)
     ->where(function($q){
       $q->where('type', '=', 'Current')
       ->orWhere('type', '=', 'Savings');
     })

     ->orderBy('created_at', 'desc')
     ->paginate(10);
     return view('deposit')->withUsers($users);
   }
}
