<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorie;
use App\Models\ticket;
use App\Models\User;
use App\Models\client;
use DB;
use Session;


class SocietyController extends Controller
{
     public function ViewSociety(){
    	$datas= client::all();
    	return view('Society.view',['displaying'=>$datas]);
    }
    public function CreateSociety(){
    	$datas= client::all();
    	return view('Society.create',['displaying'=>$datas]);
    }
    
    public function StoreNewSociety(Request $request){
        // IF STATMENT session::flash('Error','error');
    	$Society_obj = new client();

    	//setting values of the user

    	$Society_obj->SocietyName =$request->SocietyForm; 
	    
	    //save data
	    $Society_obj->save();
        session::flash('success','Succès'); //'success' is the variable used to check , and 'Success' is the valid variable that will be printed in master
         // controller
	    return redirect()->route('Society.view');
    }

    public function EditSociety($id)
    { 
        // return category::find($id);
        
        $data= client::find($id);
        return view('Society.edit',['data'=>$data]);
    }
    public function UpdateSociety(Request $req)
    {

        $data= client::find($req->id);
        $data->SocietyName=$req->SocietyForm;
        $data->save();
        session::flash('success','Succès'); // controller
        // success
        return redirect()->route('Society.view');
    }
    public function DeleteSociety($id){
        //return User::find($id);
        $datas= client::find($id);

     $result = true;
     $Soc_count= ticket::where('Society',$id)->count();
     $Soc_count2= User::where('Society',$id)->count();
     
     if($Soc_count!=0 || $Soc_count2!=0)
        $result=false;
//this will be always 

    if ($result) {
       $datas->delete();
        session::flash('success','Succès'); // controller
        return redirect()->route('Society.view');
     }else{
        //if the result is false
        session::flash('Error','Erreur');
        return redirect()->back();
     }

    
    
}

}
