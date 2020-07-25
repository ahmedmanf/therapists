<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Reservation;
class ReservationController extends Controller
{
    public function reserve(Request $request)
    {
        $attributes = $request->validate([
            'therapist_id' => 'required|integer',
            'time' => 'required|date',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|max:25'
        ]);
        $attributes['time'] = Carbon::parse($attributes['time'])->format('Y-m-d H:i:s');
        Reservation::create($attributes);
        return redirect()->route('index')->with('status', 'Reservation stored ');
    }

    public function list()
    {
        if (!empty(request('search'))) {
            $data = Reservation::where(function($query)
            {
                $query->where('id','=', request('search'))
                    ->orwhere('therapist_id','=', request('search'))
                    ->orwhere('name','LIKE', "%".request('search')."%")
                    ->orwhere('email','LIKE', "%".request('search')."%")
                    ->orwhere('mobile','LIKE', "%".request('search')."%")
                    ->orwhere('time','LIKE', "%".request('search')."%");
            })->latest()->paginate(30);
        }
        else {
            $data = Reservation::latest()->paginate(30);
        }
        return view('dashboard.reservations',['data'=>$data]);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('status', 'Reservation deleted successfully ');
    }
}
