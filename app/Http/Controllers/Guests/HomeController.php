<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendNewMail;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guests.home');
    }

    public function contactFormCreate(){
        return view('guests.contacts');
    }

    public function contactFormManager(Request $request){

        $data = $request->all();

        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();

        Mail::to('account@mail.it')->send(new SendNewMail($newLead));

        return redirect()->route('guests.thanks')->with("lead", $newLead->name);
    }

    public function contactFormEnder(){
        return view('guests.thanks');
    }
}
