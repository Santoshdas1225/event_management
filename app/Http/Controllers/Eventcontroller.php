<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Eventfeedback;
use App\Models\Feedback;
use App\Models\Notification;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class Eventcontroller extends Controller
{
    public function login()
    {
        return view('login');
    }

    ///////////////////////////////////GOOGLE LOGIN ////////////////////////////////////////////////

    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        
            $user = Socialite::driver('google')->user();
            $findUser = Customer::where('mail_id', $user->getEmail())->first();
            if($findUser)
                {
                    Session::put('photo', $findUser->photo);
                    Session::put('name', $findUser->name);
                    Session::put('email', $findUser->mail_id);
                    Session::put('id', $findUser->id);
                    Session::put('user_type', $findUser->user_type);
                }

            if (!$findUser) {
              
                $newUser = new Customer();
                $newUser->name = $user->getName();
                $newUser->mail_id = $user->getEmail();
                $newUser->password = encrypt('12345678');
                $newUser->photo = $user->getAvatar();
                $newUser->is_enable = '1';
                
                $newUser->save();
                // Auth::login($newUser);

                if($newUser)
                {
                    Session::put('photo', $newUser->photo); 
                    Session::put('email', $newUser->mail_id);
                    Session::put('name', $newUser->name);
                    Session::put('id', $newUser->id);
                    Session::put('user_type', $newUser->user_type);
                }
                return redirect('home');
            } else {
                // Auth::login($findUser);
                return redirect('home');
            }
    }

    
    public function logout(Request $request)
    {
        // 
        if(Session::has('email'))
        {
            $request->session()->flush();
            return redirect('home');
        }
        
    }
//////////////////////////////////////////////////////////////////////////////////////
    public function home(Request $res)
    {
        $today = now();
        $home = "home";
        $afterOnemonth = (clone $today)->modify('+1 month');
        $events = Event::where('date', '>', $today->format('Y-m-d')) // Events after today
                    ->where('date', '<=', $afterOnemonth->format('Y-m-d')) // Events within one month
                    ->orderBy('created_at', 'desc')
                    ->limit(6)
                    ->get();
            
        $upcomingEvents = Event::where('date', '>', $afterOnemonth->format('Y-m-d'))
                      ->orderBy('created_at', 'desc')
                      ->limit(6)
                      ->get();
        
        if(isset($res->name))
        {   
            $data =new Feedback();
            $data->name = $res->name;
            $data->email = $res->email;
            $data->feedback = $res->feedback;
            if(Session::get('id'))
            {
                $data->user_id = Session::get('id');
            }
            $data->save();
            return redirect('home')->with('success','Feedback Submitted');
        }

        if(Session::get('id'))
        {
            $user = Customer::where('id', Session::get('id'))->first(); // Fetch the user

            // Get the last notification click time or default to one year ago
            $lastClickTime = $user->last_notification_click 
                 ? new \DateTime($user->last_notification_click) 
                 : (new \DateTime())->modify('-1 month');

            // Fetch notifications created after the last click time
            $notifications = Notification::where('user_id', $user->id)
                 ->orderBy('created_at', 'desc')
                 ->get();

            // Count unread notifications (those created after the last click time)
            $unreadCount = Notification::where('user_id', $user->id)
                 ->where('created_at', '>', $lastClickTime->format('Y-m-d H:i:s'))
                 ->count();

                 return view('home',compact('events','upcomingEvents','notifications', 'unreadCount','home'));
        }
       
        return view('home',compact('events','upcomingEvents','home'));
    }

    public function storeClickTime(Request $request)
    {
        $user = Customer::where('id', Session::get('id'))->first(); // Fetch the user model instance

        if ($user) {
            $user->last_notification_click = (new \DateTime())->format('Y-m-d H:i:s'); // Update the timestamp
            $user->save(); // Save the changes to the database
        }
        

    return response()->json(['success' => true]);
    }
    public function getNotificationCount()
    {

    $user = Customer::where('id', Session::get('id'))->first();
    
    // Convert last_notification_click to DateTime if it's not null
    $lastClickTime = $user->last_notification_click 
                     ? new \DateTime($user->last_notification_click) 
                     : (new \DateTime())->modify('-1 month'); // Default to one year ago if never clicked

    // Count unread notifications (those created after the last click time)
    $unreadCount = Notification::where('user_id', $user->id)
                     ->where('created_at', '>', $lastClickTime->format('Y-m-d H:i:s')) // Correctly use format() on DateTime
                     ->count();

    return response()->json(['unreadCount' => $unreadCount]);
}



    public function userdashboard()
    {
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
        $events = Event::get();
        $eventCount = $events->count(); 
        return view('userdashboard',compact('events','eventCount'));   
    }
    public function addevent(Request $res)
    {
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
        if(isset($res->title))
        {
            $data = new Event();
            $data->event_name = $res->title;
            $data->location= $res->location;
            $data->date = $res->eventdate;
            $data->duration = $res->duration;
            $data->description = $res->desc;
            if ($res->hasFile('chooseFile')) {
                $file = $res->file('chooseFile');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = 'photos/';
                $file->move(public_path($path), $filename);
                $data->photo = $path . $filename;
            }
            else{
                $data->photo = 'noimage.png';
            }
            $data->	total_tickets = $res->total_ticket;
            $data->user_id = Session::get('id');
            $data->premium_tickets = $res->premium_tickets;
            $data->general_tickets = $res->general_tickets;
            $data->	premium_price = $res->preticket;
            $data->general_price = $res->genticket;
            $data->free_tickets = $res->total_ticket - ($res->premium_tickets+$res->general_tickets);
            $data->save();
            return redirect()->back()->with('success','Event created Successfully');
            
        }
        return view('addevent');   
    }

    public function editevent(Request $res, $id)
    {
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
        $data = Event::where('id',$id)->first();
        $i = 0;
        if($data)
        {
            if ($res->has('title')) {
                $data->event_name = $res->title;
                $i++;
            }
            if ($res->has('location')) {
                $data->location = $res->location;
                $i++;
            }
            if ($res->has('eventdate')) {
                $data->date = $res->eventdate;
                $i++;
            }
            if ($res->has('duration')) {
                $data->duration = $res->duration;
                $i++;
            }
            if ($res->has('desc')) {
                $data->description = $res->desc;
                $i++;
            }
            if ($res->hasFile('chooseFile')) {
                $file = $res->chooseFile;
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'photos/';
                $file->move($path, $filename);
    
                // Update photo path
                $data->photo = $path . $filename;
                $i++;
            }
            if ($res->has('total_ticket')) {
                $data->total_tickets = $res->total_ticket;
                $i++;
            }
            if ($res->has('premium_tickets')) {
                $data->premium_tickets = $res->premium_tickets;
                $i++;
            }
            if ($res->has('general_tickets')) {
                $data->general_tickets = $res->general_tickets;
                $i++;
            }
            if ($res->has('premium_price')) {
                $data->premium_price = $res->premium_price;
                $i++;
            }
            if ($res->has('general_price')) {
                $data->general_price = $res->general_price;
                $i++;
            }
            $data->save();
        }
        if($i > 0)
        {
            return redirect()->route('editevent',['id' => $id])->with('success', 'Event updated successfully');
        }
        return view('editevent',compact('data'));
    }

    public function eventdetails(Request $res,$id)
    {
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
        $event = Event::withCount(['bookings as paid_bookings_count' => function ($query) {
            $query->where('is_paid', 1);
        },
        'bookings as ticket_premium_booking' => function ($query) {
            $query->where('ticket_type', 'premium'); 
        },
        'bookings as ticket_general_booking' => function ($query) {
            $query->where('ticket_type', 'general'); 
        },
        'bookings as ticket_free_booking' => function ($query) {
            $query->where('ticket_type', 'free'); 
        }])->where('id', $id)->first();

        
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found');
        }
        return view('eventdetails',compact('event'));
    }

    /////////////////////////////booking details ////////////////////////////////////////////
    public function booking(Request $request ,$id = null)
    {
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
        $today =now();
       
        if($id)
        {
            $event = Event::where('id',$id)->first();
        }
        else
        {
            $event = Event::where('date', '>', $today)->orderBy('created_at', 'desc')->get();
        }
     
        if($request->has('a_name')) {
            $paymentId = $request->paymentID;
            foreach ($request->a_name as $key => $name) {
                
                if ($name) {
                    $item = new Booking();
                    $item->event_id = $request->eventname;
                    $item->customer_name = $name;
                    $item->age = $request->a_age[$key] ?? null;
                    // $item->sector = $request->sector[$key] ?? null;
                    $item->id_proof_type = $request->id_proof[$key] ?? null;
                    $item->	id_proof_no = $request->id_number[$key] ?? null;
                    $item->ticket_type = $request->type ?? null;
                    $item->ticket_price = $request->price ?? null;
                    $item->user_id = Session::get('id') ?? null;
                    $item->payment_id =  $paymentId;
                    $item->save();
                }   
            }

            $payment = new Payment();
            $payment->payment_id = $paymentId;
            $payment->event_id = $request->eventname;
            $payment->user_id = Session::get('id') ?? null;
            $payment->ticket_type = $request->type ?? null;
            $payment->person = $request->total_person ?? null;
            $payment->total_amount = $request->total_price ?? null;
            $payment->save();
           

            return redirect('payment')->with(['success' => 'Saved', 'payment_id' => $paymentId]);
        }

    
        return view('bookingpage',compact('event','id'));
    }


    
    public function getPrice(Request $request)
    {
        $eventId = $request->event_id;
        $type = $request->type;

        // Assuming you have a `price` column in your `events` table for each ticket type
        $event = Event::where('id', $eventId)->first();
     
        if ($event) {
            if ($type == 'premium') {
                $price = $event->premium_price; // Assuming you have a premium_price column
            } elseif ($type == 'general') {
                $price = $event->general_price; // Assuming you have a general_price column
            } elseif (($type == 'free')) {
                $price = 0; // Assuming you have a free_price column or handle free events
            }

            return response()->json(['price' => $price]);
        } else {
            return response()->json(['price' => null]);
        }
    }


    public function payment(Request $res)
    {
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
        $paymentID= session('payment_id');
        $paymentdetails = Payment::where('payment_id', session('payment_id'))
        ->join('events', 'payments.event_id', '=', 'events.id')
        ->select('payments.*', 'events.event_name','events.date')
        ->first();
        
       if(isset($res->c_number) && isset($res->cvv) )
        {
            $payment_id= $res->payment_id;
            $paymentdetail = Payment::where('payment_id', $payment_id)->first();
            // echo $paymentdetail;
            // exit();
            $paymentdetail->is_paid = 1;
            $paymentdetail->save();
            $customers = Booking::where('user_id',Session::get('id'))->where('payment_id',$payment_id)->get();
            foreach($customers as $c)
            {
                $c->is_paid = 1;
                $c->save();
            }
            if ($paymentdetail->is_paid == 1) {
                $notification = new Notification();
                $notification->event_id = $paymentdetail->event_id;
                $notification->payment_id = $paymentdetail->payment_id;
                $notification->user_id = Session::get('id') ?? null;
                $notification->remark = "Your booking for event " . $paymentdetail->event_name . " is confirmed.";
                $notification->save();

                $bookingdetails = Payment::where('payment_id', $payment_id)
                ->join('events', 'payments.event_id', '=', 'events.id')
                ->select('payments.*', 'events.event_name','events.date')
                ->first();  
                // echo $bookingdetails;
                // exit();

                $pdf = Pdf::loadView('ticketpdf', compact('bookingdetails', 'customers','payment_id'));
                $fileName = $paymentdetail->payment_id . '.pdf';
                $pdfPath = public_path('pdfs/' . $fileName);
                $pdf->save($pdfPath);

                session()->flash('pdf', $fileName);
            }
            return redirect('home')->with(['success' => 'Payment Successfull.Your ticket is being downloaded.']);
        }
        return view('payment',compact('paymentdetails','paymentID'));
    }

    public function manageevent()
    {
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
        $events = Event::where('user_id',Session::get('id'))->get();
        return view('manageevent',compact('events'));
    }
    public function managebooking()
    {   
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
        $eventIds = Event::where('user_id', Session::get('id'))->pluck('id');
        $bookings = Booking::whereIn('event_id', $eventIds)
                    ->join('events', 'bookings.event_id', '=', 'events.id')
                    ->select('bookings.*', 'events.event_name')
                    ->get();
        return view('managebooking', compact('bookings'));
    }

    public function allevents(Request $request)
    {
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
    // Define or fetch event types (e.g., from a database or a static list)
    $eventTypes = ['premium', 'general', 'free']; // Example types

    // Initialize the query and apply filters as shown above
    $query = Event::query();
    $eventname = Event::get()->pluck('event_name');
    if ($request->filled('eventname')) {
        $query->where('event_name', 'LIKE', '%' . $request->input('eventname') . '%');
    }

    if ($request->filled('start_date')) {
        $query->where('date', '>=', $request->input('start_date'));
    }

    if ($request->filled('end_date')) {
        $query->where('date', '<=', $request->input('end_date'));
    }

    if ($request->filled('type')) {
        if($request->type == "premium")
        {
            $query->where('premium_tickets', '>', 0);
        }
        elseif($request->type == "general")
        {
            $query->where('general_tickets', '>', 0);
        }
        elseif($request->type == "free")
        {
            $query->where('free_tickets', '>', 0);
        }
    }

    if ($request->filled('location')) {
        $query->where('location', 'LIKE', '%' . $request->input('location') . '%');
    }

    $events = $query->orderBy('created_at', 'desc')->get();

    return view('allevents', compact('events', 'eventTypes','eventname'));
    }

    public function mytickets()
    {
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
        $tickets = Payment::where('payments.user_id', Session::get('id'))
        ->join('events', 'payments.event_id', '=', 'events.id')
        ->select('payments.*', 'events.event_name')
        ->get();
        
        return view('mytickets', compact('tickets'));
    }

    public function eventfeedback(Request $res)
    {
        if(Session::get('email') == '' || Session::get('email') == null){
			return redirect('/login');
		}
        if(isset($res->likelyAttend) && isset($res->attendBefore) )
        {
            $feedback = new Eventfeedback();
            $feedback->event_id = $res->event_id;
            $feedback->event_name = $res->event_name;
            $feedback->	is_attend = $res->attendBefore;
            $feedback->likelyAttend = $res->likelyAttend;
            $feedback->likelyRecommendFriend = $res->likelyRecommendFriend;
            $feedback->likeMost = $res->likeMost;
            $feedback->	likeLeast = $res->likeLeast;
            $feedback->overall = $res->overall;
            $feedback->location = $res->location;
            $feedback->events = $res->events;
            $feedback->coordinators = $res->coordinators;
            $feedback->eventsPrice = $res->eventsPrice;
            $feedback->suggestion = $res->suggestion;
            $feedback->save();
            return redirect('mytickets')->with('success','Feedback Submitted');
        }
    }

    public function downloadTicket($payment_id)
    {
    $filePath = public_path('pdfs/' . $payment_id . '.pdf');

    if (file_exists($filePath)) {
        return response()->download($filePath);
    } else {
        return redirect()->back()->with('error', 'Ticket not found.');
    }
    }


    
    public function checkCustomer(Request $request)
    {
    
    $email = Session::get('email');

    $customer = Customer::where('mail_id', $email)->first();

    $isNewCustomer = $customer ? !$customer->contact_no : true;
      
        return response()->json(['isNewCustomer' => $isNewCustomer]);
    }

public function submitMobileNumber(Request $request)
{
    $email = Session::get('email');
    $data = Customer::where('mail_id', $email )->first();
    if ($data){
        if ($request->has('mobile_number')) {
            $data->contact_no = $request->mobile_number;
        }
        if ($request->has('whatsapp_number')) {
            $data->whatsapp_no = $request->whatsapp_number;
        }
        $data->save();   
    }
    
    return response()->json(['success' => true, 'message'=>'Contact details added successfully']);
}

public function checkSessionEmail()
{
    return response()->json(['hasEmail' => Session::has('email')]);
}


}
