@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __($employee->fullName() . ' of ' .$company->name) }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="mx-3 mb-5">
                    <a href="{{ route('companies.employees.edit', ['company' => $company->id, 'employee' => $employee->id]) }}">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                    <form class="d-inline" data-confirm method="POST" action="{{ route('companies.employees.destroy', ['company' => $company->id, 'employee' => $employee->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>  
                </div>
                <div class="px-3 pb-3 container">
                    <div class="row">
                        <div class="col">
                            <div class="h5 py-1">Name: {{ $employee->fullName() }}</div>
                            <div class="h5 py-1">Email: {{ $employee->email ?? 'N/A' }}</div>
                            <div class="h5 py-1">Phone: {{ $employee->phone ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
@endsection
