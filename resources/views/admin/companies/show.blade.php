@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __($company->name) }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="mx-3 mb-5">
                    <a href="{{ route('companies.edit', ['company' => $company->id]) }}">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                    <a href="{{ route('companies.employees.create', ['company' => $company->id]) }}">
                        <button class="btn btn-success">Add New Employee</button>
                    </a>
                </div>
                <div class="px-3 pb-3 container">
                    <div class="row">
                        <div class="col-md-4">
                            <h1 class="h2">{{ $company->name }}</h1>
                            <img class="img-thumbnail img-max-150x150" src="{{ $company->logoUrl() }}" alt="{{ $company->name }} Logo">
                        </div>
                        <div class="col-md-8">
                            <div class="h5 py-1">Email: {{ $company->email ?? 'N/A' }}</div>
                            <div class="h5 py-1">Website: {{ $company->website ?? 'N/A' }}</div>
                            <div class="h5 py-1">Employees: {{ count($company->employees) }}</div>
                        </div>
                    </div>
                </div>
                <div class="px-3 py-3">
                    <h2 class="h3 my-3">Employees</h2>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                    <tr>
                                        <th scope="row">{{ $employee->id }}</th>
                                        <td><a href="{{ route('companies.employees.show', ['company' => $company->id, 'employee' => $employee->id]) }}">{{ $employee->first_name }} {{ $employee->last_name }}</a></td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>

                                            <a href="{{ route('companies.employees.edit', ['company' => $company->id, 'employee' => $employee->id]) }}">
                                                <button class="btn btn-primary">Edit</button>
                                            </a>
                                            <form class="d-inline" data-confirm method="POST" action="{{ route('companies.employees.destroy', ['company' => $company->id, 'employee' => $employee->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>                     
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $employees->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
