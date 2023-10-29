
<div class="tab-pane active" id="new" aria-labelledby="new-tab" role="tabpanel">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Unread Message</th>
                <!--         <th>Student Email</th>
                       <th>Student Phone</th>    -->
                <th  class="float-right">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($new as $appointment)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>{{ $appointment->user->name ?? 'N/A' }}</td>
                    @php
                        $message=\App\Models\Message::where('user_id',$appointment->user->id)->where('is_read',false)
                                    ->whereHas('conversation',function($q){
                                       $q->where('sender_id',auth()->user()->id)->orWhere('receiver_id',auth()->user()->id);
                                    })->get();
                        if($message!==null && count($message)>0)
                            {
                                $toastr=true;
                            }
                    @endphp



                    <td>{{ $message!==null ? count($message) : 'N/A' }}</td>
                <!--                 <td>{{ $appointment->user->email ?? 'N/A' }}</td>
                                <td>{{ $appointment->user->phone ?? 'N/A' }}</td>     -->
                    <td class="pull-right">
                        @if (App\Models\InquirySchedule::where('inquiry_id', $appointment->id)->count() > 0)
                            <a class="btn btn-success" href="{{route('tutor.single_user_session_list',['id'=>$appointment->id])}}">View
                                Schedule</a>
                        @else
                            <a class="btn btn-info" href="{{route('tutor.session_add_form', ['id'=>$appointment->id])}}">Add
                                Schedule</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane " id="regular" aria-labelledby="regular-tab" role="tabpanel">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Unread Messages</th>
                <!--            <th>Student Email</th>
                            <th>Student Phone</th>     -->
                <th  class="float-right">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($regular as $appointment)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>{{ $appointment->user->name ?? 'N/A' }}</td>
                    @php
                        $message=\App\Models\Message::where('user_id',$appointment->user->id)->where('is_read',false)
                                    ->whereHas('conversation',function($q){
                                       $q->where('sender_id',auth()->user()->id)->orWhere('receiver_id',auth()->user()->id);
                                    })->get();
                            if($message!==null && count($message)>0)
                            {
                                $toastr=true;
                            }
                    @endphp


                    <td>{{ $message!==null ? count($message) : 'N/A' }}</td>


                <!--             <td>{{ $appointment->user->email ?? 'N/A' }}</td>
                                <td>{{ $appointment->user->phone ?? 'N/A' }}</td>     -->
                    <td class="pull-right">
                        @if (App\Models\InquirySchedule::where('inquiry_id', $appointment->id)->count() > 0)
                            <a class="btn btn-success" href="{{route('tutor.single_user_session_list',['id'=>$appointment->id])}}">View
                                Schedule</a>
                        @else
                            <a class="btn btn-info" href="{{route('tutor.session_add_form', ['id'=>$appointment->id])}}">Add
                                Schedule</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    @if(isset($toastr) && $toastr==true)
    toastr.success('You have receive a message');
    @endif
</script>
