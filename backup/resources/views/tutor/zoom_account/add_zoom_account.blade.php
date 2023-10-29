@extends("tutor.layouts.app")
@section('content')
@include('admin.partials.success_message')
@section('topbar-heading', 'Zoom account link')
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Link Zoom account</h5>
        <h6 class="card-subtitle mb-2 text-muted">Why zoom attach?</h6>
        <p class="card-text">Zoom attachement is mandatory in order to start meetings with students. if you will not attach your account. you will not be able to start session.</p>
        <div class="text-center">
            
            @if(Auth::User()->zoom_access_token == null)
                <a href="{{ route('tutor.link.zoom') }}?flag=attach" class="btn btn-primary">LINK ZOOM NOW</a>
            @else
                <button class="btn btn-success disabled">Your account is linked with zoom</button>
            @endif
            
            
        </div>
      </div>
    </div>
  </div>
  @stop
