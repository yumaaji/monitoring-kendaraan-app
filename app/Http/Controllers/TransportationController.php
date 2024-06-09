<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Transportation;
use Symfony\Component\Mailer\Transport;

class TransportationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transport.index', [
            'pageTitle' => 'Kendaraan',
            'transports' => Transportation::all(),
            'companies' => Company::all(),
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transport.create', [
            'pageTitle' => 'Kendaraan | Tambah',
            'companies' => Company::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = $request->validate([
            'company_id' => ['required'],
            'name' => ['required'],
            'product_type'=> ['required'],
            'transportation_type' => ['required'],
            'fuel' => ['required'],

            'cost' => ['nullable'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
        ]);

        if($request->cost == null) {
            unset($rules['start_date']);
            unset($rules['end_date']);
        }

        Transportation::create($rules);

        return redirect('/kendaraan')->with('success', 'Data kendaraan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        
        $transport = Transportation::with('company')->findOrFail($id);
        return response()->json($transport);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('transport.edit', [
            'pageTitle' => 'Kendaraan | Edit',
            'transport' => Transportation::findOrFail($id),
            'companies' => Company::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'id' => ['required'],
            'company_id' => ['required'],
            'name' => ['required'],
            'product_type'=> ['required'],
            'transportation_type' => ['required'],
            'fuel' => ['required'],

            'cost' => ['nullable'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
        ];

        $validateData = $request->validate($rules);

        if($request->cost == null) {
            unset($rules['start_date']);
            unset($rules['end_date']);
        }

        Transportation::where('id', $id)->update($validateData);
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transport = Transportation::findOrFail($id);
        $transport->delete();
        return redirect('/kendaraan')->with('success', 'Data kendaraan berhasil dihapus');
    }
}
