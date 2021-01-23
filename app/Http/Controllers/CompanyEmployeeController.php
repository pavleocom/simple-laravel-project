<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployee;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class CompanyEmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Employee::class, 'employee');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        return redirect()->route('companies.show', ['company' => $company->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        return view('admin.employees.create', ['company' => $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Company $company, StoreEmployee $request)
    {
        $validatedData = $request->validated();
        $validatedData['company_id'] = $company->id;
        $employee = Employee::create($validatedData);

        return redirect()->route('companies.employees.show', [
            'company' => $company->id,
            'employee' => $employee->id
            ])->with('status', 'The employee was successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company, Employee $employee)
    {
        return view('admin.employees.show', [
            'employee' => $employee,
            'company' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, Employee $employee)
    {
        return view('admin.employees.edit', [
            'employee' => $employee,
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployee $request, Company $company, Employee $employee)
    {
        $validatedData = $request->validated();
        $validatedData['company_id'] = $company->id;
        $employee->fill($validatedData);
        $employee->save();

        return redirect()->route('companies.employees.show', [
            'company' => $company->id,
            'employee' => $employee->id
            ])->with('status', 'The employee was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, Employee $employee)
    {
        $employee->delete();
        return redirect()->route('companies.show', ['company' => $company->id]);
    }
}
