<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\ticket;
use App\Models\ticket_replay;
use App\Models\categorie;
use App\Models\history_aff;
use App\Models\User;
use App\Models\client;
use Auth;
use App\Class\Traitment;


use DB;

class TicketController extends Controller
{

    // ticket
    public function Adding(){
    	$societies =client::all();
        $categories = categorie::all();
    	return view("ticket.create")->with('categories',$categories)->with('societies',$societies);

    }
    public function Storing(Request $request){


        $Traitment = new Traitment();
    	$ticket_obj = new ticket();
    	 //ticket is the model of table tickets 
    	//setting values of the user

    	$ticket_obj->Title =$request->TitleForm; 
	    $ticket_obj->Cat =$request->CatForm;
	    $ticket_obj->Problem =$request->ProblemForm;
        if (isset($request->SocietyForm)) {
            $ticket_obj->Society =$request->SocietyForm;
        }else{
            $ticket_obj->Society =Auth::user()->Society;
        }


	    $ticket_obj->id_user = Auth::user()->id;
        $ticket_obj->status  = "Pending";
        // the ticket will be automatically pending after creating it. 
        
	    //save data  
	    $ticket_obj->save();
        $ticket = ticket::find($ticket_obj->id);
        $userID = Auth::user()->id;//this will hold the id the the user that is actually logging in
        if($request->btn_sub=="yes"){
            // this is the part of partager (if you click on button partager you ll ve yes in the vlue of btn_sub that is no by default)
            $ticket_obj->Share_flag = "1";
            $ticket_obj->save(); // flg should become 1 hich means this ticket is shared 
        $users = user::where('Category',3)->get();//this will return the whole line of the user that is loggin in, then we can find the users->email

        foreach ($users as $value) {
            # code...
            if($Traitment->SendEmail($value->FirstName,$value->LastName,$ticket->Title,$ticket->Problem,$value->email)){
            //the email should be sent to Admin only, and then the admin can afffect it to the user
            }else{

            }
        }


        }else{
        $users = user::where('Category',1)->get();//this will return the whole line of the user that is loggin in, then we can find the users->email

        foreach ($users as $value) {
            # code...
            if($Traitment->SendEmail($value->FirstName,$value->LastName,$ticket->Title,$ticket->Problem,$value->email)){
            //the email should be sent to Admin only, and then the admin can afffect it to the user
            }else{

            }
        }
        }




         session::flash('success','Succès');
         // return redirect()->route('ticket.view')->with('categories',$categories);
        return redirect()->route('ticket.view')->with('users',$users);
    }
    
    function showing(){
    // return view("UserInfo");
        $use=User::all();
        $data= User::where('Category',3)->orWhere('Category',1)->get();
        //we should display the agents and admins only
        $datas2=history_aff::all();
        $datas= ticket::all();
        $data3= User::all();
        $societies =client::all();
        switch (Auth::user()->Category) {
            case 1:
                # code...
            $datas= ticket::all();
                break;
            case 2:
                # code...
            $datas= ticket::where('id_user',Auth::user()->id)->get();//id_user is the id of the user in the ticket and will will get the whenever there is a line of that user in the ticket(in other words, we will get the id of the user that created a ticket)
                break;
            case 3:
                # code...
            $datas= ticket::where('id_user',Auth::user()->id)->Orwhere('AffectedId',Auth::user()->id)->get();
            //the agent can create a ticket so he should be able to see the tickets that he created, and the agent should be able to see the affected tickets, so we should go ti ticket table and check the AffectedId and compare it with the id of the person who is logging in, if any AffectedId in the table is equal to the id logged in we should get it. 
                break;
        }
        $da= User::all();
        $categories = categorie::all();
        return view('ticket.view',['History'=>$datas2,'displaying'=>$datas,'categories'=>$categories,'display'=>$data,'da'=>$da,'data3'=>$data3, 'use'=>$use, 'societies'=>$societies]);
    }
    public function edit($id)
    {
        // return ticket::find($id);
        # code...
        $categories = categorie::all();
        $datas= ticket::find($id);

        return view('ticket.edit')->with('categories',$categories)->with('datas',$datas);
    }
    public function update(Request $req)
    {

        $datas= ticket::find($req->id);
        if (isset($req->TitleForm)) {
            $datas->Title=$req->TitleForm;
        }
        if (isset($req->CatForm)) {
            $datas->Cat=$req->CatForm;
        }
        if (isset($req->ProblemForm)) {
            $datas->Problem=$req->ProblemForm;
        }
        $datas->save();
         session::flash('success','Succès');
        return redirect()->route('ticket.view');
    }
    public function delete($id){
    $datas= ticket::find($id);
    $datas->delete();
    return redirect()->route('ticket.view');
}

//REPLY FUNCTIONS 
    public function show($id)
    {
        # code...
        $ticket = ticket::find($id);//ticket will return the TICKETS WITH THIS ID (THE ID IS COMMING FROM THE ROOT(ID OF ticket WHICH IS DEFINED IN TICKET.VIEW) 
       
        $Cat = categorie::find($ticket->Cat);//we want to know the category of the returned ticket (it is coming from categories table this is why we called categorie model)
        $replys = ticket_replay::where('id_ticket',$id)->orderBy('id', 'DESC')->get();//$replys WILL HOLD THE whole line where the id_ticket=$id ($id is coming from the root)
        $users = User::All();//it will allow us to find the whole list

        
        return view('ticket.show')->with('ticket',$ticket)->with('Cat',$Cat)->with('replys',$replys)->with('users',$users);//go to ticket.show
    }
public function HistoryReply($id)
    {
        
        $ticket = ticket::find($id);//ticket will return the TICKETS WITH THIS ID (THE ID IS COMMING FROM THE ROOT(ID OF ticket WHICH IS DEFINED IN TICKET.VIEW) 
       
        $Cat = categorie::find($ticket->Cat);//we want to know the category of the returned ticket (it is coming from categories table this is why we called categorie model)
        $replys = ticket_replay::where('id_ticket',$id)->orderBy('id', 'DESC')->get();//$replys WILL HOLD THE whole line where the id_ticket=$id ($id is coming from the root)
        $users = User::All();//it will allow us to find the whole list

        return view('ticket.History')->with('ticket',$ticket)->with('Cat',$Cat)->with('replys',$replys)->with('users',$users);//go to ticket.show
    }
    public function StoreReply($id,Request $request){
        //return dd(Auth::user());
        
        $reply_obj = new ticket_replay();
        $status = new ticket();
         //ticket is the model of table tickets 
        //setting values of the user
        $Traitment = new Traitment();
        $reply_obj->message =$request->MessageForm; 
        $reply_obj->id_ticket=$id;
        $reply_obj->id_user=Auth::user()->id;
        
        
        //save data
        $reply_obj->save();
        $ticket = ticket::find($id);
        $ticket2 = ticket::find($id);
        $userID = Auth::user()->id;//this will hold the id the the user that is actually logging in
        // $ticket->status = $request->StatusForm;
        //return dd($ticket2->status);
        if ($request->StatusForm == 1) {
            // check if the returned value by the select form is 1, So if it is 1 we should change the status to Closed and then save ticket2 to be updated in the database and ticket view as well
            $ticket2->status = "Closed";
        }
        $ticket2->save();
        //this will return the whole line of the user that is loggin in, then we can find the users->email
        $replys = ticket_replay::find($reply_obj->id);
            //reply_obj is the last object that is saved so when we did $reply_obj->id we will find the id of the last rely saved then, we will print the message of the reply in the email
            //we can take directly $request->MessageForm in sendEmail function without doing this step(it hold the message of the email while creating it)
        
        if ($userID==$ticket->id_user) {//$userID is the id of the person who is logging in and the $ticket->id_user is the id of the person who created the ticket, so if the person who is logging in is the one who have created the ticket go to next if statement
            if(isset($ticket->AffectedId)){ //check if the ticket is already affected
                 $users = user::find($ticket->AffectedId);
            # code...
                if($Traitment->SendEmail($users->FirstName,$users->LastName,'User Response',$replys->message,$users->email)){//send email to the person who affected the ticket
            
                }else{

                }
            }else{

                $usersALL = user::where('Category',3)->Orwhere('Category',1)->get();//this will return the whole line of the user that is loggin in, then we can find the users->email

                foreach ($usersALL as $value) {//otherwise, we have to send the email to every agent (if the ticket is not affected to anyone)
                    # code...
                    if($Traitment->SendEmail($value->FirstName,$value->LastName,$ticket->Title,$ticket->Problem,$value->email)){
                            //the email should be sent to all the agents
                    }else{

                    }
                }


            }

        }
        if ($userID==$ticket->AffectedId) {
            $users = user::find($ticket->id_user);
            $Traitment = new Traitment();
            # code...
            if($Traitment->SendEmail($users->FirstName,$users->LastName,'Réponse de l utilisateur',$replys->message,$users->email)){
            
            }else{

            }
        }

         session::flash('success','Succès');

        return redirect()->back();
         // return redirect()->route('ticket.view')->with('categories',$categories);
       // return redirect()->back();
    }
//END REPLY FUNCTIONS 
    public function share($id)
    {
        $ticket_shre = new ticket();
        $Traitment = new Traitment();
        $Ticket_share = ticket::find($id);
        $userID = Auth::user()->id;//this will hold the id the the user that is actually logging in

       
      

                $usersALL = user::where('Category',3)->get();//this will return the whole line of the user that is loggin in, then we can find the users->email

                foreach ($usersALL as $value) {//otherwise, we have to send the email to every agent (if the ticket is not affected to anyone)
                    # code...
                    if($Traitment->SendEmail($value->FirstName,$value->LastName,$Ticket_share->Title,$Ticket_share->Problem,$value->email)){
                            //the email should be sent to all the agents
                    }
                }

            $Ticket_share->Share_flag = "1"; // IF THE TICKET IS SHRED E NEED TO CHNGE THE FLG
            $Ticket_share->save();
            session::flash('success','Succès');
            return redirect()->back();

        }

    
    
}
