<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.index', [
            'pageTitle' => 'Company',
            'companies' => Company::all()
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
            'role_company' => ['required'],
        ]);

        Company::create($rules);

        return redirect('/company')->with('success', 'Data perusahaan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return response()->json($company);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company){
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->all());
        return redirect()->route('company.index')->with('success', 'Data perusahaan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect('/company')->with('success', 'Data perusahaan berhasil dihapus');
    }
}
