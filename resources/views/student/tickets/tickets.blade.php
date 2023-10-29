@extends("student.layouts.app")
@section('css')
<style>
    .mce-notification-inner,.mce-close,.mce-notification {display:none!important;}
    .text-center{
        text-align: center;
    }
    .text-right{
        text-align: right;
    }
    .green-btn{
        background-color: #5cb85c;
        color:#fff;
        padding:5px 10px;
        border-radius: 5px;
    }
    .red-btn {
        background-color: #ea5455;
        color:#fff;
        padding:5px 6px;
        border-radius: 5px;
    }
    .blue-bg{
        background-color: #daeef7;
    }
    .useo i{
        font-size:38px;
    }
    .pt-2{
        padding-top:20px;
    }
    .pt-1{
        padding-top:10px;
    }
    .p20{
        padding:20px;
    }
    .p10{
        padding:10px;
    }
    .no-m{
        margin:0;
    }
    .sec-box{
        margin-top:10px;
        background-color: #f2f9ff;


    }
    .sec-box p{
        margin-bottom:0;

    }
    .star{
        text-align: right;

    }
    .border-bl{
        padding-top: 10px;

        border:3px solid #f2f9ff;
    }
    .star i{
        color: #f3dd87;
        font-size:24px;
        padding-right: 2px;
    }
    .head1{
        margin-bottom: 10px;
    }
</style>
@endsection
@section('content')
@include('admin.partials.success_message')
@section('topbar-heading',  'My Orders' )

<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section class="relative no-top no-bottom " data-bgimage="" data-stellar-background-ratio=".2">

       <div class="container mb-5 p-0">

        <div class="content-body">
            <section id="basic-tabs-components">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-content">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <p class="head1"><b>Order Information</b></p>
                                            <p><span class="badge badge-primary">#{{ $ticket->ticket_id }}</span></p>
                                            @if ($ticket->status == "open")
                                            <div class="chip chip-success mb-2">
                                                <div class="chip-body">
                                                    <div class="chip-text text-white"><b>Open</b></div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="chip bg-grey mb-2">
                                                <div class="chip-body">
                                                    <div class="chip-text text-white"><b>Cancel</b></div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 ">
                                            <p class="head1"><b>Category</b></p>
                                            <p>Support</p>
                                        </div>
                                        <div class="col-md-12 ">
                                            <p class="head1"><b>Submitted</b></p>
                                            <p>{{ $ticket->created_at }}</p>
                                        </div>
                                        <div class="col-md-12 ">
                                            <p class="head1"><b>Last Updated</b></p>
                                            <p>{{ $ticket->updated_at }}</p>
                                        </div>
                                        <div class="col-md-12 ">
                                            <p class="head1"><b>Priority</b></p>
                                            <p>{{ $ticket->priority }}</p>
                                        </div>
                                        <div class="col-md-12 text-center">

                                            @if ($ticket->status == "open")
                                            <a href="{{ route('student.ticket.close_ticket', $ticket->id) }}"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Close</button></a>
                                            @else
                                            <span class="badge badge-success">Closed</span>
                                            @endif


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="alert alert-primary">{{ $ticket->subject }}</h2>
                                            @if ($ticket->status == "closed")
                                            <p>This ticket is closed</p>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <p>{!! $ticket->description !!}</p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="accordion" id="accordionExample" data-toggle-hover="true">
                                                <div class="collapse-margin">
                                                    <div class="card-header collapsed" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                        <span class="lead collapse-title">
                                                            <i class="fa fa-pencil"></i> <strong>Reply Now</strong>
                                                        </span>
                                                    </div>

                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                                                        <div class="card-body">
                                                            <form action="{{ route('student.ticket.save_comment') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticket->id }}">
                                                                <textarea data-length="20" class="form-control char-textarea" id="textarea-counter" rows="5" name="comment"></textarea>
                                                                <div class="row">
                                                                    <div class="col-12 text-center mt-2">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (count($ticket->comments)>0)
                                            @foreach ($ticket->comments as $item)
                                                @if ($item->user_id == auth()->user()->id)
                                                    <div class="col-12">
                                                        <div class="card blue-bg">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-6 m-auto">
                                                                            <p>{{ $item->created_at }}</p>
                                                                        </div>
                                                                        <div class="col-6 text-right">
                                                                            <div class="media">
                                                                                <div class="media-body">
                                                                                    <p class="mb-0">{{ $item->user->name }}</p>
                                                                                    <p class="mb-0"><strong>{{ $item->user->role }}</strong></p>
                                                                                </div>
                                                                                <div class="media-right ml-2">
                                                                                    <img src="{{ asset($item->user->avatar) }}" alt="avatar" height="45" width="45">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-2"></div>
                                                                    <p>{!! $item->comment !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <div class="card blue-bg">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="media">
                                                                                <div class="media-left mr-2">
                                                                                    <img src="{{ asset($item->user->avatar) }}" alt="avatar" height="45" width="45">
                                                                                </div>
                                                                                <div class="media-body">
                                                                                    <p class="mb-0">{{ $item->user->name }}</p>
                                                                                    <p class="mb-0"><strong>{{ $item->user->role }}</strong></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 text-right">
                                                                            <p>{{ $item->created_at }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-2"></div>
                                                                    <p>{!! $item->comment !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

       </div>

    </section>
    <!-- section close -->

</div>
<!-- content close -->
<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5g5faf78gvk6yfq9bd3bbfjo858kjx1q8o0nbiwtygo2e4er'></script>
<script>tinymce.init({selector:'textarea'});</script>
@stop


