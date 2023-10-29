
@foreach ($inquiries->sortByDesc("id") as $appointment)
    <tr>
        <td class="text-center">
            @php
                $diff = \Carbon\Carbon::now()->diffInDays($appointment->created_at);
            @endphp

            <a href="{{route('student.session',['id'=>base64_encode($appointment->id)])}}" class="btn btn-success btn-block font-weight-bold">View Schedule</a>



            @if($appointment->is_paid == 0 )
                <a href="{{ route('student.payments.index', ['id' => base64_encode($appointment->id)]) }}" class="btn btn-primary btn-block font-weight-bold">Pay Inquiry</a>
            @endif




        </td>
        <td>{{ $appointment->created_at->diffForHumans() ?? 'N/A' }}</td>
        <td>
            @if($appointment->is_paid)
                <span class="badge badge-success">Paid</span>
            @else
                <span class="badge badge-danger">Not Paid</span>
            @endif
        </td>
        <td>
            <span class="badge badge-primary">{{ str_replace('_', ' ', $appointment->status) }}</span>
        </td>
        <td>
            @php
                $message=\App\Models\Message::where('user_id',$appointment->tutor_id)->where('is_read',false)
                            ->whereHas('conversation',function($q){
                               $q->where('sender_id',auth()->user()->id)->orWhere('receiver_id',auth()->user()->id);
                            })->get();
                if($message!==null && count($message)>0)
                    {
                        $toastr=true;
                    }
            @endphp
            {{ $message!==null ? count($message) : 'N/A' }}
        </td>
        

    </tr>
@endforeach
<script>
    @if(isset($toastr) && $toastr==true)
    toastr.success('You have receive a message');
    @endif
</script>
