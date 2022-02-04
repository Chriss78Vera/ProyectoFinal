<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use Illuminate\Http\Request;


class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('can:manage-wards');
    }


    public function index()
    {
        $wards = Ward::query();

        if (request('search'))
        {
            $wards = $wards->where('name', 'like', '%' . request('search') . '%');
        }

        $wards = $wards->orderBy('name', 'asc')
            ->paginate();

        return view('ward.index', compact('wards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ward.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required', 'string', 'min:3', 'max:45'],
            'location' => ['required', 'string', 'min:3', 'max:45'],
            'description' => ['nullable', 'string', 'min:5', 'max:255'],
        ]);
        $ward = new Ward();

        $ward->create([
            "name" => $request['name'],
            "location" => $request['location'],
            "description" => $request['description']
        ]);

        return back()->with('status', 'Ward created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('ward.show', ['ward' => $ward]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('ward.update', ['ward' => $ward]);
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
        $request->validate([
            'name'=> ['required', 'string', 'min:3', 'max:45'],
            'location' => ['required', 'string', 'min:3', 'max:45'],
            'description' => ['nullable', 'string', 'min:5', 'max:255'],
        ]);

        $ward->update([
            "name" => $request['name'],
            "location" => $request['location'],
            "description" => $request['description']
        ]);

        return back()->with('status', 'Ward updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = $ward->state;
        $message = $state ? 'inactivated' : 'activated';

        if ($this->verifyWardHasAssignedGuards($ward))
        {
            return back()->with([
                'status' => "The ward $ward->name has assigned guard(s).",
                'color' => 'yellow'
            ]);
        }

        $ward->state = !$state;

        $ward->save();

        return back()->with('status', "Ward $message successfully");
    }

        private function verifyWardHasAssignedGuards(Ward $ward)
        {
            return (bool)$ward->users->count();
        }
}
