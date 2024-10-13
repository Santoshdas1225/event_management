<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Eventcontroller;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});


///////////////////////////////////GOOGLE LOGIN /////////////////////////////////////////////

Route::any('/login',[Eventcontroller::class,'login']);
Route::get('/google', [Eventcontroller::class, 'redirectToGoogle'])->name('google.login');
Route::get('/google/callback', [Eventcontroller::class, 'handleGoogleCallback'])->name('google.callback'); 

Route::any('/logout', [Eventcontroller::class, 'logout']);
/////////////////////////////////////////////////////////////////////////////////////////////


Route::any('/home',[Eventcontroller::class,'home'])->name('home');
Route::any('/userdashboard',[Eventcontroller::class,'userdashboard'])->name('userdashboard');

Route::any('/addevent',[Eventcontroller::class,'addevent']);

Route::any('/editevent/{id}',[Eventcontroller::class,'editevent']);

Route::any('/eventdetails/{id}',[Eventcontroller::class,'eventdetails'])->name('editevent');

Route::any('/booking/{id?}',[Eventcontroller::class,'booking'])->name('booking');

Route::get('/get-price', [EventController::class,'getPrice']);

Route::any('/payment', [EventController::class,'payment']);

Route::any('/manageevent', [EventController::class,'manageevent']);

Route::any('/managebooking', [EventController::class,'managebooking']);

Route::any('/allevents', [EventController::class,'allevents']);

Route::any('/mytickets', [EventController::class,'mytickets']);

Route::any('/eventfeedback', [EventController::class,'eventfeedback']);

Route::any('/notifications/click', [EventController::class, 'storeClickTime'])->name('notifications.click');

Route::get('/download-ticket/{payment_id}', [EventController::class, 'downloadTicket'])->name('download.ticket');


Route::get('/notifications/count', [EventController::class, 'getNotificationCount'])->name('notifications.count');


Route::get('/check-customer', [EventController::class, 'checkCustomer']);
Route::post('/submit-mobile-number', [EventController::class, 'submitMobileNumber']);
Route::any('/check-session-email', [EventController::class, 'checkSessionEmail']);

///////////////////////////////////////////// ADMIN ROUTES ///////////////////////////////////////
Route::any('/allcustomer',[AdminController::class,'allcustomer']);

Route::post('/toggleCustomerStatus', [AdminController::class, 'toggleStatus'])->name('toggleCustomerStatus');

Route::any('/deletecustomer/{id}',[AdminController::class,'deletecustomer']);

Route::any('/adminallevent',[AdminController::class,'allevent']);

Route::any('/admindeleteevent/{id}',[AdminController::class,'deleteevent']);

Route::any('/adminallbooking',[AdminController::class,'allbooking']);

Route::any('/admindeletebooking/{id}',[AdminController::class,'deletebooking']);


