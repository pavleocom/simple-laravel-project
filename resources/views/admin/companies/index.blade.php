@extends('layouts.app')

@section('content')
<x-breadcrumbs/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="mx-3 mb-5">
                        <a href="{{ route('companies.create') }}">
                            <button class="btn btn-success">Add New Company</button>
                        </a>
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Website</th>
                            <th scope="col">No. Employees</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                                    <tr>
                                        <th scope="row">{{ $company->id }}</th>
                                        <td><a href="{{ route('companies.show', ['company' => $company->id]) }}">{{ $company->name }}</a></td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->website }}</td>
                                        <td>{{ $company->employees_count }}</td>
                                        <td>
                                            <a href="{{ route('companies.edit', ['company' => $company->id]) }}">
                                                <button class="btn btn-primary">Edit</button>
                                            </a>
                                            <form class="d-inline" data-confirm method="POST" action="{{ route('companies.destroy', ['company' => $company->id]) }}">
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
                            {{ $companies->links("pagination::bootstrap-4") }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
