<?php

namespace App\Http\Controllers;

use App\Mail\SendNewsletter;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function suscribeToNewsletter(Request $data) {
        $data->validate([
            'email_subs' => 'required|max:50'
        ]);

        if(Auth::check()){
            Mail::to($data->email_subs)->send(new SendNewsletter(Auth::user()->name));
        }
        elseif(Auth::guard('custom')->user()->name){
            Mail::to($data->email_subs)->send(new SendNewsletter(Auth::guard('custom')->user()->name));
        }
        else{
            Mail::to($data->email_subs)->send(new SendNewsletter(''));
        }
        return back();
    }
}
