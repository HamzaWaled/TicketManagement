<?php
namespace App\Http\Controllers;


use Session;

use Illuminate\Http\Request;
use App\Models\ticket;
use App\Models\history_aff;
use App\Models\ticket_replay;
use App\Models\categorie;
use App\Models\User;
use Auth;
use App\Class\Traitment;

class AffectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,$user)
    {
        // this id in the parametre is given from the view blade 
        // this user is given from the view blade 
         $Traitment = new Traitment();
         $users = user::where('Category',3)->get();//this will return the whole line of the user that is loggin in, then we can find the users->email
        $ticket = ticket::find($id);
        $ticket->AffectedId=$user;
        $ticket->status="Affected";
        //right after affecting the ticket we should change the status automatically to affected
        $ticket->save();

        $history_aff = new history_aff();
        $history_aff->id_user=Auth::user()->id;
        //the person who is logging in is the one that he will affect the ticket
        // id_user is the person affect the ticket
        $history_aff->AffectedId=$user;
        // AffectedId is the person who was affected by the ticket
        $history_aff->TicketId =$id;
        $history_aff->save();


        foreach ($users as $value) {
            if ($ticket->AffectedId ==$value->id) {
                //the email should be sent to the affected agent only which is the affectedId
                if($Traitment->SendEmail($value->FirstName,$value->LastName,$ticket->Title,$ticket->Problem,$value->email)){
            
                }else{

                }
            }
            # code...
           
        }
        session::flash('success','Succès');

        return redirect()->back();
        // the back will go to ticket page, so every thing that is in the ticket will be passed here as well. 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         # code...
        $ticket_aff = history_aff::all();
        $users = User::All();
        
        return view('ticket.show')->with('ticket',$ticket)->with('Cat',$Cat)->with('replys',$replys)->with('users',$users);//go to ticket.show

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
