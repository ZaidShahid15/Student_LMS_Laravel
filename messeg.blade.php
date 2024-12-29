@if (!empty(session('success')))
    <div class="alert alert-success">
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger">
        <span>{{ session('error') }}</span>
    </div>
@endif
