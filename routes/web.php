<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\ticket;
use App\Models\categorie;
use App\Models\ticket_replay;
use App\Models\history_aff;
use App\Models\client;
use App\Http\Controllers\SocietyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AffectController;
use App\Http\Controllers\DashboardController;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

// Society is the client in database

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//email
// Route::get('/email',function(){

// 	Mail::to('h.waled@aui.ma')->send(new WelcomeMail());
// 	return new WelcomeMail();
// });
Route::get('/SendEmail',[MailController::class, "SendEmail"]);
Route::get('/test',[MailController::class, "index"]);
Route::get('/ts',[MailController::class, "envUpdate"]);

//end email

//share
Route::get("/ticket/{id}/share",[TicketController::class,"share"])->name('ticket.share');
//end share

//society
Route::get("/ViewSociety",[SocietyController::class,"ViewSociety"])->name('Society.view');
Route::get("/CreateSociety",[SocietyController::class,"CreateSociety"])->name('Society.create');
Route::post("/save-Society",[SocietyController::class, "StoreNewSociety"]);
Route::get("/Society/{id}/edit",[SocietyController::class,"EditSociety"])->name('Society.edit');

Route::post("/Society/{id}/edit",[SocietyController::class,"UpdateSociety"])->name('Society.edit.update');
Route::get("/Society/{id}/delete",[SocietyController::class, "DeleteSociety"])->name('Society.delete');
//end society

//User
Route::get("/UserFillingForm",[UserController::class,"Add"])->name('user.add');
Route::get("/ListUsers",[UserController::class,"show"])->name('user.view');
Route::post("/save-client",[UserController::class, "Store"]);
Route::get("/user/{id}/edit",[UserController::class,"editing"])->name('user.editt');
Route::post("/user/{id}/edit",[UserController::class,"updating"])->name('user.edit.update');
Route::get("/user/{id}/delete",[UserController::class, "deleting"])->name('user.deletee');
//end User



//login/logout
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login_index');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'store'])->name('login_post');
//end login/logout
Route::get('/forgetpassword', [App\Http\Controllers\LoginController::class, 'passwordforget'])->name('password_frg');
Route::post('/forgetpassword', [App\Http\Controllers\LoginController::class, 'changepassword'])->name('changepassword');
//Affect

Route::get("/ticket/{id}/affect/{user}",[AffectController::class, "store"])->name('affect_ticket');
//eND aFFECT
//history replies
Route::get("/HistoryRep/{id}",[TicketController::class, "HistoryReply"])->name('History.rep');

//end history replies


//ticket
Route::get("/FillTicketForm",[TicketController::class,"Adding"]);
Route::post("/save-ticket",[TicketController::class, "Storing"]);

Route::get("/DisplayTable",[TicketController::class,"showing"])->name('ticket.view');
Route::get("/ticket/{id}/edit",[TicketController::class,"edit"])->name('ticket.edit');
Route::post("/ticket/{id}/edit",[TicketController::class,"update"])->name('ticket.edit.update');
Route::get("/ticket/{id}/delete",[TicketController::class, "delete"])->name('ticket.delete');
	
	// storing reply
	Route::get("/ticket/{id}",[TicketController::class, "show"])->name('ticket.show');//first step
	Route::post("/ticket/{id}/replay",[TicketController::class,"StoreReply"])->name('ticket.rep.store');
	// end storing reply
//end ticket



// category
Route::get("/ViewCategory",[CategoryController::class,"ViewCat"])->name('category.view');
Route::get("/CreateCategory",[CategoryController::class,"CreateCat"])->name('category.create');
Route::post("/save-category",[CategoryController::class, "StoreNewCat"]);
Route::get("/Category/{id}/edit",[CategoryController::class,"EditCat"])->name('category.edit');
Route::post("/Category/{id}/edit",[CategoryController::class,"UpdateCat"])->name('category.edit.update');
Route::get("/Category/{id}/delete",[CategoryController::class, "DeleteCat"])->name('category.delete');
// end category


// Dashboard
Route::get("/Dashboard",[DashboardController::class,"DisplayDashboard"])->name('dash_view');
Route::post("/Dashboard",[DashboardController::class,"Search"])->name('dash_search');
//the search route is to filter in dashboard by dates
// end dashboard



Route::get("/DropdownCat",[TicketController::class,"Adding"])->name('ticket.create');//I don't know what I have changed here

//submit and save data



// Route::delete("/service-cate-delete/,{id}",[UserController::class,"deleting"])->name('user.deletee');

// Route::post("/ticket/{id}/edit",[TicketController::class,"update"])->name('ticket.edit.update');
// Route::get("/ticket/{id}/delete",[TicketController::class, "delete"])->name('ticket.delete');
