<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\categorie;
use App\Models\ticket;
use DB;


class CategoryController extends Controller
{
    public function ViewCat(){
    	$datas= categorie::all();
    	return view('Category.view',['displaying'=>$datas]);
    }
    public function CreateCat(){
    	$datas= categorie::all();
    	return view('Category.create',['displaying'=>$datas]);
    }
    
    public function StoreNewCat(Request $request){
        // IF STATMENT session::flash('Error','error');
    	$Category_obj = new categorie();

    	//setting values of the user

    	$Category_obj->CategoryName =$request->CategoryForm; 
	    
	    //save data
	    $Category_obj->save();
        session::flash('success','Succès'); //'success' is the variable used to check , and 'Success' is the valid variable that will be printed in master
         // controller
	    return redirect()->route('category.view');
    }

    public function EditCat($id)
    {
        // return category::find($id);
        
        $data= categorie::find($id);
        return view('Category.edit',['data'=>$data]);
    }
    public function UpdateCat(Request $req)
    {

        $data= categorie::find($req->id);
        $data->CategoryName=$req->CategoryForm;
        $data->save();
        session::flash('success','Succès'); // controller
        // success
        return redirect()->route('category.view');
    }
    public function DeleteCat($id){
        //return User::find($id);
        $datas= categorie::find($id);

     $result = true;
     $Cat_count= ticket::where('Cat',$id)->count();
     if($Cat_count!=0)
        $result=false;


    if ($result) {
       $datas->delete();
        session::flash('success','Succès'); // controller
        return redirect()->route('category.view');
     }else{
        //if the result is false
        session::flash('Error','Erreur');
        return redirect()->back();
     }

    
    
}


}

