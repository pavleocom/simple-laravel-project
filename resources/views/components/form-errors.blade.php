@if ($errors->any())
    <div class="mt-2 mb-2">
        @foreach ($errors->all() as $error)
            <div class="aler alert-danger px-3 py-1" role="aler">
                {{ $error }}
            </div>
        @endforeach
    </div>    
@endif