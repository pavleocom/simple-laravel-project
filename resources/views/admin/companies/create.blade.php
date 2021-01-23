@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Add New Company') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="px-3 pb-5">
                    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label><br>
                            <input id="name" type="text" name="name" value="{{ old('name', $company->name ?? null) }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label><br>
                            <input id="email" type="text" name="email" value="{{ old('email', $company->email ?? null) }}">
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label><br>
                            <input id="website" type="text" name="website" value="{{ old('website', $company->website ?? null) }}">
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label><br>
                            <input class="form-control-file" id="logo" type="file" name="logo">
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
