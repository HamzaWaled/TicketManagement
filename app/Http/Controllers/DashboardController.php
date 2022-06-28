<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\ticket;
use App\Models\User;

class DashboardController extends Controller
{
    public function DisplayDashboard(){
    	//$top5agents = DB::table('top5agent')->orderBy('total','desc')->take(5)->get();
        $datef = null;
        $datel = null;
                $top5agents = DB::table('top5agent')
        ->select('FirstName','LastName',DB::raw("SUM(total) as total"))
        //->whereBetween('updated_at',array($req->fdate,$req->ldate))
        ->groupBy('FirstName','LastName')
        ->orderBy('total','desc')->take(5)->get();
    	$user= User::all();
    	$Tickets= ticket::all();
    	$userTop= User::where('status',"Closed");
       $CountTickets= ticket::all()->count();
    	return view("Dashboard.view")->with('CountTickets',$CountTickets)->with('Tickets',$Tickets)->with('userTop',$userTop)->with('top5agents',$top5agents)->with('datef',$datef)->with('datel',$datel)->with('user',$user);

    }
    public function Search(Request $req)
    {
        $datef = $req->fdate;
        $datel = $req->ldate;
        // we added these 2 variables in order to print them when the user enter a date
    	$top5agents = DB::table('top5agent')
        ->select('FirstName','LastName',DB::raw("SUM(total) as total"))
        ->whereBetween('updated_at',array($req->fdate,$req->ldate))
        ->groupBy('FirstName','LastName')
        ->orderBy('total','desc')->take(5)->get();
        

        
        $Tickets= ticket::whereBetween('updated_at',array($req->fdate,$req->ldate))->get();
        $userTop= User::where('status',"Closed");
       $CountTickets= ticket::whereBetween('updated_at',array($req->fdate,$req->ldate))->count();


        return view("Dashboard.view")->with('CountTickets',$CountTickets)->with('Tickets',$Tickets)->with('userTop',$userTop)->with('top5agents',$top5agents)->with('datef',$datef)->with('datel',$datel);
    }
}
