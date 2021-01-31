<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\StoreCompany;
use App\Http\Requests\UpdateCompany;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Company::class, 'company');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.companies.index', [
           'companies' => Company::withCount('employees')->paginate(10)
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $validatedData = $request->validated();
        $validatedData['email'] = $request->input('email');
        $validatedData['website'] = $request->input('website');

        if ($request->hasFile('logo')) {

            $path = $request->file('logo')->store('logos');
            $company = Company::make($validatedData);
            $company->logo = $path;
            $company->save();
            return redirect()->route('companies.show', ['company' => $company->id])
                    ->with('status', __('The company was successfully created.'));

        } else {

            return back()->withErrors('File was not uploaded.')->withInput();
            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('admin.companies.show', [
            'company' => $company,
            'employees' => Employee::where('company_id', '=', $company->id)->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', [
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateCompany  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompany $request, Company $company)
    {
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');

        if ($request->hasFile('logo')) {
            $oldPath = $company->logo;
            $path = $request->file('logo')->store('logos');
            $company->logo = $path;

            if ($oldPath !== null) {
                Storage::delete($oldPath);
            }
        }

        $company->save();

        return redirect()->route('companies.show', ['company' => $company->id])
                ->with('status', 'The company information was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return back()->with('status', 'The company was successfully deleted.');
    }
}
