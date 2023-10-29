@extends('admin.layouts.app')
@section('title', 'Conversation')
@section('heading', 'Conversation')
@section('content')


<div class="row" id="DivIdToPrint">
    <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Chat Conversation</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($messages as $message)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span><strong class="text-capitalize text-primary">{{$message->user->name}} - <small class="text-secondary">{{$message->user->role}}</small>: </strong><em>{{ $message->message }}</em></span>
                                                    <span class="text-secondary" style="white-space: nowrap !important;">{{ $message->created_at->diffForHumans() }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
</div>

<div class="text-center pb-2">
    <input type='button' id='btn' class="btn btn-dark" value='Print conversation' onclick='printDiv();'>
</div>

@stop

@section('js')
<script>
    function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>
@endsection