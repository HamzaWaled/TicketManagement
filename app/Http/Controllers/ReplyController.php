<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ticket_replay;

class ReplyController extends Controller
{
    public function AddReply(){
    	//LAYOUT
        $rep = ticket_replay::all();
    	return view("reply.create")->with('rep',$rep);

    }
     public function StoreReply(Request $request){

    	$reply_obj = new ticket_replay();
    	 //ticket is the model of table tickets 
    	//setting values of the user

    	$reply_obj->message =$request->ReplyForm; 
	    
	    $Status= ticket::all();
	    //save data
	    $reply_obj->save();
         session::flash('success','Succès');
         // return redirect()->route('ticket.view')->with('categories',$categories);
       
    }
    function showReply(){
    // return view("UserInfo");
        $datas= ticket_replay::all();
        
        return view('reply.view',['displaying'=>$datas]);
    }
}
