@if(session('status') !== null)
<aside class="alert alert-success" role="alert">
    {{ session('status') }}
</aside>
@endisset
@if(session('error') !== null)
<aside class="alert alert-danger" role="alert">
    {{ session('error') }}
</aside>
@endisset