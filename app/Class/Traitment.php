<?php
namespace App\Class;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class Traitment
{

	public function SendEmail($Fname,$Lname,$title,$body,$sendto)
	{
		$details = [
        'Fname'=> $Fname,
        'Lname'=> $Lname,
    	'title' => $title,
    	'body' => $body
    ];
    	if(Mail::to($sendto)->send(new WelcomeMail($details))){
    		return true;
    	}else{
    		return false;
    	}
    
	}

}