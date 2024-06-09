<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Lending;
use Illuminate\Http\Request;
use App\Exports\LendingExport;
use App\Models\Transportation;
use Maatwebsite\Excel\Facades\Excel;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lending.index', [
            'pageTitle' => 'Pengajuan',
            'lendings' => Lending::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lending.create',[
            'pageTitle' => 'Pengajuan | Tambah',
            'transports' => Transportation::all(),
            'drivers'=> Driver::all(),
            'supervisors' => User::all()->where('role', 'penjabat')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = $request->validate([
            'status' => ['required'],
            'transport_id' => ['required'],
            'driver_id' => ['required'],
            'purpose' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'supervisor_id' => ['required']
        ]);

        Lending::create($rule);
        
        return redirect('/pengajuan')->with('success', 'Pengajuan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lending = Lending::with('company', 'transport', 'driver', 'supervisor')->findOrFail($id);        
        return response()->json($lending);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('lending.edit', [
            'pageTitle' => 'Pengajuan | Edit',
            'lending' => Lending::findOrFail($id),
            'transports' => Transportation::all(),
            'drivers'=> Driver::all(),
            'supervisors' => User::all()->where('role', 'penjabat'),
            'companies' => Company::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rule = [
            'status' => ['required'],
            'transport_id' => ['required'],
            'driver_id' => ['required'],
            'purpose' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'supervisor_id' => ['required']
        ];

        $validateData = $request->validate($rule);

        Lending::where('id', $id)->update($validateData);
        
        return redirect('/pengajuan')->with('success', 'Pengajuan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lending = Lending::findOrFail($id);
        $lending->delete();
        return redirect('/pengajuan')->with('success', 'Data pengajuan berhasil dihapus');
    }

    public function list()
    {
        return view('lending.index', [
            'pageTitle' => 'Pengajuan',
            'lendings' => Lending::all()
        ]);
    }

    public function approve(Request $request, string $id){
        $lending = Lending::find($id);
        $lending->update([
            'status' => '2'
        ]);
        return redirect('/pengajuan-kendaraan')->with('success', 'Pengajuan berhasil di approve');
    }

    public function unapprove(Request $request, string $id){
        $lending = Lending::find($id);
        $lending->update([
            'status' => '3'
        ]);
        return redirect('/pengajuan-kendaraan')->with('success', 'Pengajuan berhasil di unapprove');
    }

    public function waiting(Request $request, string $id){
        $lending = Lending::find($id);
        $lending->update([
            'status' => '1'
        ]);
        return redirect('/pengajuan-kendaraan')->with('success', 'Status pengajuan berhasil di reset');
    }

    public function export(){
        return Excel::download(new LendingExport, 'Riwayat Pengajuan-'. Carbon::now()->timestamp .'.xlsx');
    }
}
