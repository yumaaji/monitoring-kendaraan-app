<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('driver.index', [
            'pageTitle' => 'Driver',
            'drivers' => Driver::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $rules = $request->validate([
            'name' => ['required'],
            'address' => ['required'],
            'gender' => ['required'],
        ]);

        Driver::create($rules);

        return redirect('/driver')->with('success', 'Data driver baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $driver = Driver::findOrFail($id);
        return response()->json($driver);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->update($request->all());
        return redirect()->route('driver.index')->with('success', 'Data driver berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();
        return redirect('/driver')->with('success', 'Data driver berhasil dihapus');
    }
}
