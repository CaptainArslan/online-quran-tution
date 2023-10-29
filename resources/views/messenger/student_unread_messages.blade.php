@php use Carbon\Carbon; @endphp
@php use App\Models\Message; @endphp
@if ($inquiries->isEmpty())
    <tr class="text-center">
        <td colspan="7">
            <h4><span class="badge badge-success">Create Child Profile To get assigned to a tutor</span></h4>
        </td>
    </tr>
@else
    @foreach ($inquiries->sortByDesc('id') as $appointment)
        <tr>
            <td class="text-center">

                @php
                    $diff = Carbon::now()->diffInDays($appointment->created_at);
                @endphp

                @if ($appointment->status != 'cancelled')
                    <a href="{{ route('student.session', ['id' => base64_encode($appointment->id)]) }}"
                        class="btn btn-success btn-block font-weight-bold">View Schedule</a>


                    @if ($appointment->is_paid == 0)
                        <a href="{{ route('student.payments.index', ['id' => base64_encode($appointment->id)]) }}"
                            class="btn btn-primary btn-block font-weight-bold">Pay Inquiry</a>
                    @endif
                @else
                    N/A
                @endif


            </td>
            <td>{{ $appointment->created_at->diffForHumans() ?? 'N/A' }}</td>
            <td>
                @if ($appointment->is_paid)
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
                    $message = Message::where('user_id', $appointment->tutor_id)
                        ->where('is_read', false)
                        ->whereHas('conversation', function ($q) {
                            $q->where('sender_id', auth()->user()->id)->orWhere('receiver_id', auth()->user()->id);
                        })
                        ->get();
                    if ($message !== null && count($message) > 0) {
                        $toastr = true;
                    }
                @endphp
                {{ $message !== null ? count($message) : 'N/A' }}
            </td>
            @php
                $trialDuration = 7; // Trial duration in days
                $trailStart = null;
                $trailEnd = null;
                $remainingDays = null;
                
                if (is_null($appointment->trial_start)) {
                    $remainingDays = 'Trail Not Started';
                } else {
                    $trailStartDate = DateTime::createFromFormat('d/m/Y', $appointment->trial_start);
                    $trailStart = $trailStartDate->format('d-m-Y');
                    $trailEndDate = clone $trailStartDate;
                    $trailEndDate->modify('+' . $trialDuration . ' days');
                    $trailEnd = $trailEndDate->format('d-m-Y');
                
                    $remainingDays = $trailEndDate->diff(new DateTime())->format('%a');
                }
                
            @endphp
            {{--        <td>{{ $appointment->trail_start ? $remainingDays : "Trail Not Started" }}</td> --}}
            <td>{{ $remainingDays }}</td>
            <td>
                {{ $appointment->child->name ?? 'N/A' }}
            </td>

        </tr>
    @endforeach
@endif
<script>
    @if (isset($toastr) && $toastr == true)
        toastr.success('You have receive a message');
    @endif
</script>
