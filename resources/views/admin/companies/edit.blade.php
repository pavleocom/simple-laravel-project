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
                <div class="px-3 pb-5">
                    <form method="POST" action="{{ route('companies.update', ['company' => $company->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label><br>
                            <input id="name" type="text" name="name" value="{{ $company->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label><br>
                            <input id="email" type="text" name="email" value="{{ $company->email ?? null }}">
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label><br>
                            <input id="website" type="text" name="website" value="{{ $company->website ?? null }}">
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label><br>
                            <input class="form-control-file" id="logo" type="file" name="logo">
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                    
                </div>
                <x-form-errors/>
            </div>
        </div>
    </div>
</div>
@endsection
