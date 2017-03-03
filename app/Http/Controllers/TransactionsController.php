<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Transaction;
use App\User;
use Session;
use Hash;

class TransactionsController extends Controller
{
  public function registercs(Request $request) {
    $user = new User;
    $this->validate($request, [
      'name' => 'required|max:191',
      'email' => 'required|email|max:191',
      'password' => 'required|confirmed|max:191',
    ]);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->type = 'CS';
    $user->save();
    Session::flash('Success', 'Customer Service Account has been successfuly created');
    return redirect()->back();
  }


  public function passwords(Request $request) {
    $user = Auth::user();
    if (Hash::check($request->password, $user->old_password))
    {
    $this->validate($rerquest, [
      'password' => 'required|confirmed|min:6',
    ]);
    $user->password = bcrypt($request->passowrd);
    $user->save();
    Session::flash('Success', 'Password has been successfuly updated');
    return redirect()->back();
    }
    else {
      Session::flash('Failed', 'Password does not match our record');
      return redirect()->back();
    }
  }
    public function changeType(Request $request, $id) {

        $user = User::find($id);
        $user->type = $request->type;
        $user->save();
        Session::flash('Success', 'Account type has been succesfuly updated');
        return redirect()->back();

    }


    public function withdraw(Request $request, $id) {
    $this->validate($request, [
      'amount' => 'required|regex:/^\d*(\.\d{1,2})?$/',
    ]);
    $user = User::find($id);
    $transaction = new Transaction;
    if (($user->balance - $request->amount) <= $user->balance) {
      if ($user->type == 'Savings' && $request->amount <= 10000)      {
        $transaction->user_id = $user->id;
        $transaction->type = 'Withdraw';
        $transaction->previous_balance = $user->balance;
        $transaction->credit = $request->amount;
        $transaction->balance = ($user->balance - $request->amount);
        $transaction->remarks = ('made an over the counter withdrawal for Php '.$request->amount);

        $user->balance = ($user->balance - $request->amount);

        $user->save();
        $transaction->save();
        Session::flash('Success', 'Withdrawal has been succesfuly processed');
        return redirect()->back();
      }
      if ($user->type == 'Savings' && $request->amount > 10000){
        Session::flash('Failed', 'Savings account cannot withdraw more than 10,000');
        return redirect()->back();
      }
      if ($user->type == 'Current')      {
        $transaction->user_id = $user->id;
        $transaction->type = 'Withdraw';
        $transaction->previous_balance = $user->balance;
        $transaction->credit = $request->amount;
        $transaction->balance = ($user->balance - $request->amount);
        $transaction->remarks = ('made an over the counter withdrawal for Php '.$request->amount);

        $user->balance = ($user->balance - $request->amount);

        $user->save();
        $transaction->save();
        Session::flash('Success', 'Withdrawal has been succesfuly processed');
        return redirect()->back();
      }

    }
    else {
      Session::flash('Failed', 'Cannot withdraw more than available balance');
      return redirect()->back();
    }

  }

    public function deposit(Request $request, $id) {

      $this->validate($request, [
        'amount' => 'required|regex:/^\d*(\.\d{1,2})?$/',
      ]);
      $user = User::find($id);
      $transaction = new Transaction;

      if ($user->type == 'Savings' && $request->amount > 0)      {
            if (($request->amount + $user->balance) <= 100000) {
            $transaction->user_id = $user->id;
            $transaction->type = 'Deposit';
            $transaction->previous_balance = $user->balance;
            $transaction->credit = $request->amount;
            $transaction->balance = ($user->balance + $request->amount);
            $transaction->remarks = ('made an over the counter deposit for Php '.$request->amount);
            $user->balance = ($user->balance + $request->amount);

            $user->save();
            $transaction->save();
            Session::flash('Success', 'Deposit has been succesfuly processed');
            return redirect()->back();
            }
            else {
              Session::flash('Failed', 'Savings account cannot recieve more than 100,000');
              return redirect()->back();
            }
      }
      elseif ($user->type == 'Current' && $request->amount > 0) {

            $transaction->user_id = $user->id;
            $transaction->type = 'Deposit';
            $transaction->previous_balance = $user->balance;
            $transaction->credit = $request->amount;
            $transaction->balance = ($user->balance + $request->amount);
            $transaction->remarks = ('made an over the counter deposit for Php '.$request->amount);
            $user->balance = ($user->balance + $request->amount);

            $user->save();
            $transaction->save();
            Session::flash('Success', 'Deposit has been succesfuly processed');
            return redirect()->back();
        }
        else {
            Session::flash('Failed', 'Please check the account type');
            return redirect()->back();
        }
    }


    public function payments(Request $request) {

      if (Auth::user()->balance >= $request->amount && $request->amount > 0 ) {
        $this->validate($request, [
          'merchant' => 'required',
          'amount' => "required|regex:/^\d*(\.\d{1,2})?$/",
        ]);

        $transaction = new Transaction;
        $user = User::find(Auth::user()->id);
        $balance = Auth::user()->balance;

        $transaction->user_id = $user->id;
        $transaction->type = 'Payment';
        $transaction->previous_balance = $user->balance;
        $transaction->debit = $request->amount;
        $transaction->balance = ($user->balance - $request->amount);
        $transaction->remarks = ('made a payment to '.$request->merchant.' for Php '.$request->amount);


        $user->balance = $transaction->balance;
        $transaction->save();
        $user->save();
        Session::flash('Success', 'You have successfuly processed the payment');
        return redirect()->route('home');
      }
      Session::flash('Failed', 'Insufficient Balance');
      return redirect()->back();
    }


        public function transfers(Request $request) {

          if (Auth::user()->balance >= $request->amount && $request->amount > 0 ) {
            $this->validate($request, [
              'bank' => 'required',
              'account_no' => 'required|numeric',
              'amount' => "required|regex:/^\d*(\.\d{1,2})?$/",
            ]);
            if ($request->bank = 'Bank') {
              $account = User::where('id', '=', ltrim($request->account_no, '0'))->first();
              $user = User::find(Auth::user()->id);
              if ($account === null) {
                Session::flash('Failed', 'The account does not exist in our record');
                return redirect()->back();
              }
              elseif ($account->id != $user->id) {
                if ($account->type == 'Savings' && ($account->balance + $request->amount) > 10000) {
                  Session::flash('Failed', 'Receiving account has limit');
                  return redirect()->back();
                }
                else {


                $transaction = new Transaction;
                $transaction2 = new Transaction;
                $balance = Auth::user()->balance;
                $balance2 = $account->balance;

                $transaction->user_id = $user->id;
                $transaction2->user_id = $account->id;
                $transaction->type = 'Transfer';
                $transaction2->type = 'Credit';
                $transaction->previous_balance = $user->balance;
                $transaction2->previous_balance = $account->balance;
                $transaction->debit = $request->amount;
                $transaction2->credit = $request->amount;
                $transaction->balance = ($user->balance - $request->amount);
                $transaction2->balance = ($account->balance + $request->amount);
                $transaction->remarks = ('made a transfer to '.str_pad($request->account_no, 10, 0, STR_PAD_LEFT).' for Php '.$request->amount);
                $transaction2->remarks = ('recieved a transfer from '.str_pad($user->id, 10, 0, STR_PAD_LEFT).' for Php '.$request->amount);

                $account->balance = ($account->balance + $request->amount);
                $user->balance = $transaction->balance;

                $transaction->save();
                $transaction2->save();
                $user->save();
                $account->save();
                Session::flash('Success', 'You have successfuly processed the payment');
                return redirect()->route('home');
                }

              }

              else {
                Session::flash('Failed', 'You cannot transfer to your own account');
                return redirect()->back();
              }


            }
            else {


            $transaction = new Transaction;
            $user = User::find(Auth::user()->id);
            $balance = Auth::user()->balance;

            $transaction->user_id = $user->id;
            $transaction->type = 'Payment';
            $transaction->previous_balance = $user->balance;
            $transaction->debit = $request->amount;
            $transaction->balance = ($user->balance - $request->amount);
            $transaction->remarks = ($user->name.' '.'made a Payment to '.$request->merchant.' for Php '.$request->amount);


            $user->balance = $transaction->balance;
            $transaction->save();
            $user->save();
            Session::flash('Success', 'You have successfuly processed the payment');
            return redirect()->route('home');
            }
          }
          Session::flash('Failed', 'Insufficient Balance');
          return redirect()->back();
        }
}
