
    @if(session()->has('message'))
    <div class="col-12">
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
</div>
    @endif
    
        @if(session()->has('error'))
    <div class="col-12">
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
</div>
    @endif

   