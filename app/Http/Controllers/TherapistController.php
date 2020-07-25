<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Therapist;
class TherapistController extends Controller
{
    public function ajax () {
        if (!empty(request('search'))) {
            $data = Therapist::where('active','1')->where(function($query)
            {
                $query->where('title','LIKE', "%".request('search')."%")
                    ->orwhere('description','LIKE', "%".request('search')."%");
            })->latest()->paginate(12);
        }
        else {
            $data = Therapist::where('active','1')->latest()->paginate(12);
        }
        return response()->json($data);
    }

    public function show(Therapist $therapist)
    {

        //dd($therapist->where([['active','1'],['id',$therapist->id]])->first());
        return view('therapist',['data'=>$therapist->where([['active','1'],['id',$therapist->id]])->firstOrFail()]);
    }

    public function list() {
        return view('dashboard.therapists',['data'=>Therapist::latest()->paginate(30)]);
    }

    public function search() {
        if (!empty(request('search'))) {
            $data = Therapist::where(function($query)
            {
                $query->where('id','=', request('search'))
                    ->orwhere('title','LIKE', "%".request('search')."%")
                    ->orwhere('description','LIKE', "%".request('search')."%")
                    ->orwhere('price','=', request('search'));
            })->latest()->paginate(30);
        }
        else {
            abort(403, 'Unauthorized action.');
        }
        return view('dashboard.therapists',['data'=>$data]);
    }

    public function store() {
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'picture' => 'required|mimes:jpeg,bmp,png|dimensions:min_width=150,min_height=150',
            'description' => 'required|max:1000',
            'price' => 'required|integer',
        ]);
        $attributes['active'] = (request('active') == '1') ? '1' : '0';
        $attributes['picture'] = str_replace("avatars/therapists/","",request('picture')->store('avatars/therapists'));
        Therapist::create($attributes);
        return back()->with('status', 'Therapist added successfully ');
    }

    public function edit(Therapist $therapist)
    {
        return view('dashboard.therapists-edit',['data'=>$therapist]);
    }

    public function update(Therapist $therapist)
    {
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'picture' => 'mimes:jpeg,bmp,png|dimensions:min_width=150,min_height=150',
            'description' => 'required|max:1000',
            'price' => 'required|integer',
        ]);
        $attributes['active'] = (request('active') == '1') ? '1' : '0';
        if (request('picture')) {
            $attributes['picture'] = str_replace("avatars/therapists/","",request('picture')->store('avatars/therapists'));
        }
        $therapist->update($attributes);
        return redirect()->route('therapists')->with('status', 'Therapist updated successfully ');
    }

    public function destroy(Therapist $therapist)
    {
        $therapist->delete();
        return back()->with('status', 'Therapist deleted successfully ');
    }
}
