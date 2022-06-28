<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ticket;
use App\Models\client;
use Auth;
use App\Models\ticket_replay;
use DB;

class UserController extends Controller{
    public function Add(){
    	$societies =client::all();
    	return view("User.create")->with('societies',$societies);

    }
    public function Store(Request $request){
        $societies =client::all();
    	$client_obj = new User();

    	//setting values of the user

    	$client_obj->FirstName =$request->FirstNameForm; 
	    $client_obj->LastName =$request->LastNameForm;
	    $client_obj->Category =$request->CategoryForm;
	    $client_obj->PhoneNumber =$request->PhoneNumberForm;
	    $client_obj->Email =$request->EmailForm;
        $client_obj->Society = $request->SocietyForm;
	    $client_obj->Password =$request->PasswordForm;
	    //save data
	    $client_obj->save();
        session::flash('success','Succès');
        return redirect()->route('user.view')->with('societies',$societies);
    }

    function show(){
    
        
        $societies =client::all();
        $data_Aff =ticket::all();
        $data= User::all();
        return view('User.view',['display'=>$data])->with('data_Aff',$data_Aff)->with('societies',$societies);
}
public function editing($id)
    {
        // return user::find($id);
        $societies =client::all();
        if(Auth::user()->Category!=1){
            //is the person who logged in is not an admin he can not change the id in the URL bar , because in the web we have /user/{id}/edit in edit user so anyone can change the id (/{id}/) in the url bar and go to whatever account he wants, which is very bad, so we need to redirect the user to his initial id if he tried to enter an id that is not equal to his id in the url bar. But the admin can still enter any account he wants using this security bug (changing id (/{id}/)in url bar)
            if($id!=Auth::user()->id)
                //check if the id tn the URL bar (the same id that is in the user edit route) does not match with the id of the person who is logging in.
           return redirect()->route('user.editt',['id'=>Auth::user()->id]);
       //Go back to the original id of the user that is logging in
        }
        $dataa= User::find($id);
        return view('User.edit',['dataa'=>$dataa])->with('id',$id)->with('societies',$societies);
    }
     public function updating(Request $req)
    {
        $societies =client::all();
        $dataa= User::find($req->id);
        if (isset($req->FirstNameForm)) {
            $dataa->FirstName=$req->FirstNameForm;
        }
        if (isset($req->LastNameForm)) {
            $dataa->LastName=$req->LastNameForm;
        }
        //user is not able to change his/her category
        $dataa->Category=$req->CategoryForm;
        if (isset($req->PhoneNumberForm)) {
            $dataa->PhoneNumber=$req->PhoneNumberForm;
        }
        if (isset($req->EmailForm)) {
            $dataa->Email=$req->EmailForm;
        }
        if (isset($req->PasswordForm)) {
            //if the user didnot enter anything in the form, we won't update the password
            $dataa->Password=$req->PasswordForm;
        }
         if (isset($req->SocietyForm)) {
            $dataa->Society=$req->SocietyForm;
        }
        

        $dataa->save();
         session::flash('success','Succès');
         
         if(Auth::user()->Category!=1){
            return redirect()->route('ticket.view');
         }
         else if(Auth::user()->Category==1){
            //The admin is the only one who can view the whole list of users
            return redirect()->route('user.view')->with('societies',$societies);
         }
        
       
        //return redirect()->route('User.view');
    }
public function deleting($id){
   
    //return User::find($id);
     $result = true;
     $ticket_cout= ticket::where('AffectedId',$id)->Orwhere('id_user',$id)->count();
     if($ticket_cout!=0)
        $result=false;
// the result become false if we user ($id) is  equal to the user that is in ticket table, and it is the id of the user who was affected by a specific ticket(AffectedId)
     $ticket_replay_cout= ticket_replay::where('id_user',$id)->count();
     if($ticket_replay_cout!=0)
        $result=false;
// the result become false if we user ($id) is  equal to (id_user) which means the id of the user that we want to delete is replying in a comment so we cant delete it 
    $data = User::find($id);
     if ($result) {
         
        $data->delete();
         session::flash('success','Succès');
        return redirect()->back();
     }else{
        //if the result is still true 
        session::flash('Error','Erreur');
        return redirect()->back();
     }
    
    
    // return redirect()->route('User.view');
}

}
