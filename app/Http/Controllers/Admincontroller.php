<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{
    public function allcustomer()
    {
        if(Session::get('email') == '' || Session::get('email') == null || Session::get('user_type') !== 'admin'){
			return redirect('/login');
		}
        $customers = Customer::all();
        return view('admin.allcustomer',compact('customers'));
    }

    public function toggleStatus(Request $request)
    {
        $customerId = $request->id;
        $status = $request->status;

    // Update customer status
    $customer = Customer::find($customerId);
    if ($customer) {
        $customer->is_enable = $status;
        $customer->save();
    }
   
        return response()->json(['success' => true]);
    }

    public function deletecustomer($id)
	{
        if(Session::get('email') == '' || Session::get('email') == null || Session::get('user_type') !== 'admin'){
			return redirect('/login');
		}
		
		$data = Customer::where('id', $id)->count();

		if ($data > 0) {
			Customer::where('id', $id)->delete();
		}
		return redirect()->back();
	}
    public function allevent()
	{
        if(Session::get('email') == '' || Session::get('email') == null || Session::get('user_type') !== 'admin'){
			return redirect('/login');
		}
        $events = Event::all();
        return view('admin.allevent',compact('events'));
	}
    
    public function deleteevent($id)
    {
        if(Session::get('email') == '' || Session::get('email') == null || Session::get('user_type') !== 'admin'){
			return redirect('/login');
		}
        $data = Event::where('id', $id)->count();
        if ($data > 0) {
            Event::where('id', $id)->delete();
            }
        return redirect()->back();
    }

    public function allbooking()
	{
        if(Session::get('email') == '' || Session::get('email') == null || Session::get('user_type') !== 'admin'){
			return redirect('/login');
		}
        $bookings = Booking::join('events', 'bookings.event_id', '=', 'events.id')
        ->select('bookings.*', 'events.event_name')
        ->get();
        return view('admin.allbooking',compact('bookings'));
	}
    
    public function deletebooking($id)
    {
        if(Session::get('email') == '' || Session::get('email') == null || Session::get('user_type') !== 'admin'){
			return redirect('/login');
		}
        $data = Booking::where('id', $id)->count();
        if ($data > 0) {
            Booking::where('id', $id)->delete();
            }
        return redirect()->back();
    }

}
