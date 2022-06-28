<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App;

class MailController extends Controller
{
	public function SendEmail()
	{
		$details = [
    	'title' => 'Mail from Naeem',
    	'body' => 'Internship'
    ];
    Mail::to('y.najd@aui.ma')->send(new WelcomeMail($details));
    return "Email Sent";
	}
	public function index()
	{
		$environment = env('MAIL_FROM_ADDRESS');
		return view('emails.ChangeMail',compact('environment'));
	}
	public function envUpdate()
    {
    	//return env('LOG_CHANNEL', 'Oops, I could not find that setting');
    	return [
    'LOG_CHANNEL' => env('LOG_CHANNEL', "4444")];
    }






    
}
