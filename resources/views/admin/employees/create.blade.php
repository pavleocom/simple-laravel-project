@extends('layouts.app')

@section('content')
<x-breadcrumbs/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Add New Employee') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="px-3 pb-5">
                    <form method="POST" action="{{ route('companies.employees.store', ['company' => $company->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="first-name">First Name</label><br>
                            <input id="first-name" type="text" name="first_name" value="{{ old('first_name', $employee->first_name ?? null) }}">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label><br>
                            <input id="last-name" type="text" name="last_name" value="{{ old('last_name', $employee->last_name ?? null) }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label><br>
                            <input id="email" type="text" name="email" value="{{ old('email', $employee->email ?? null) }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label><br>
                            <input id="phone" type="text" name="phone" value="{{ old('phone', $employee->phone ?? null) }}">
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                    
                </div>
                <x-form-errors/>
            </div>
        </div>
    </div>
</div>
@endsection
