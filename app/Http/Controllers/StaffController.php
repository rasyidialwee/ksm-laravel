<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return view('staff.index', [
            'staffs' => $user->staffs()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|min:5',
            'phone' => 'required|string|min:3'
        ]);

        $user = auth()->user();

        $staff = new Staff();
        $staff->name = $validated['name'];
        $staff->email = $validated['email'];
        $staff->address = $validated['address'];
        $staff->phone = $validated['phone'];

        $user->staffs()->save($staff);


        return redirect('staffs')->with('status', $staff->name . ' Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return view('staff.show', [
            'staff' => $staff
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        return view('staff.edit', [
            'staff' => $staff
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|min:5',
            'phone' => 'required|string|min:3'
        ]);

        $staff->name = $validated['name'];
        $staff->email = $validated['email'];
        $staff->address = $validated['address'];
        $staff->phone = $validated['phone'];
        $staff->save();


        return redirect('staffs')->with('status', $staff->name . ' Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect('staffs')->with('status', $staff->name . ' Deleted');
    }
}
