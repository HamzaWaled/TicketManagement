<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Str;
use App\Class\Traitment;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
	public function passwordforget()
	   {
	   	# code...
	   	return view('User.password');
	   }   
	   public function changepassword(Request $req)
	   {
	   	
	   	$Traitment = new Traitment();
	   	$exist_email = User::where('email',$req->email)->get()->count();
	   	
	   	if($exist_email!=0){
	   		$random = Str::random(6);
	   		$l = $random;
	   		$id_user = User::where('email',$req->email)->first();
	   		$update = User::find($id_user->id);
	   		$update->password=$random;
	   		$update->save();
	   		//return dd($l,$random);
            if($Traitment->SendEmail($id_user->FirstName,$id_user->LastName,"Changement mot de passe",$random,$id_user->email)){
            //the email should be sent to the person who wants to change the password
            }else{

            }


	   		session::flash('success',"Succès"); 
	   	}else{
	   		session::flash('Error','Email n existe pas');/// not exist
	   	}
	   	return view('User.login');
	   }

			public function index()
			    {
			        if(!Auth::check()){
			            return view('User.login');
			        }else{
			            return redirect()->route('dash_view');
			        }
			    	
			    }
			    public function store(Request $req){
			    	//return $req->input();
			        //client is model
			    	$user= User::where(['email'=>$req->email])->first();
			    	if(Auth::attempt(['email'=>$req->email,'password'=>$req->psw])){
			            
			           return redirect()->route('dash_view');
			        }else{
			            // echo ("wrong password");
			            
			            session::flash('Error','Mot de passe est incorrect');
			            
			            return redirect()->back();

			        }
			    }
			    public function logout()
			    {
			        # code..
			        Auth::logout();
			        return redirect()->route('login_index');
			    }
			
}
