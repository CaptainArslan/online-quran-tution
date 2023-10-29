

<div class="table-div" style="overflow-x: auto">
    <table class="table   table-striped" >
        <thead class="border">
        <th>
            ID
        </th>
        <th>
            Std Name
        </th>
        <th>
            Std Email
        </th>
        <th>
            Std Phone
        </th>
        <th>
            Inq. Status
        </th>
        <th>Trial End Date</th>
        <th>Payment Status</th>
        <th>
            Update Status
        </th>
        <th>Action</th>

        </thead>
        <tbody>
        @foreach ($searchResults as $student)
            @if(empty($student->user))
                @continue
            @endif
            <tr>
                <td>
                    {{$loop->iteration}}
                </td>
                <td>
                    {{$student->user->name ?? 'N/A'}}
                </td>
                <td>{{$student->user->email ?? 'N/A'}}</td>
                <td>{{$student->user->phone ?? 'N/A'}}</td>
                <td>
                    @if($student->status=="pending")
                        <span class="badge badge-info">
                                         Pending {{ $student->tutor ? '(Tutor assigned)' : 'N/A' }}
                                     </span>
                    @elseif($student->status=="started")
                        <span class="badge badge-success">Started</span>
                    @elseif($student->status=="cancelled")
                        <span class="badge badge-danger">Cancel</span>
                    @else
                        <span class="badge badge-warning">On Trial</span>
                    @endif
                </td>
                <td>  {{\Carbon\Carbon::parse($student->trial_end_date)->format('d/m/Y')}} </td>
                <td>
                    @if($student->is_paid == true)
                        <span class="badge badge-success">Paid</span>
                    @else
                        <span class="badge badge-warning">Pending</span>
                    @endif
                </td>

                <td width="25%">
                    <div class="btn-group">
                        @if($student->is_interested == 0)
                            <a href="{{ route('admin.inquiry.interest', [$student->id, 1]) }}" class="btn btn-success">Interested</a>
                            <a href="{{ route('admin.inquiry.interest', [$student->id, 0]) }}" class="btn btn-danger">Cancelled</a>

                        @else
                            <a href="{{route('admin.inquiry.detail',[$student->id])}}" class="btn btn-primary">Detail</a>
                        @endif


                    <!--@if($student->status=="on_trial")-->
                    <!--<a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>-->
                    <!--@elseif($student->status=="pending")-->

                    <!--@if(is_null($student->tutor_id))-->
                    <!--<a href="{{ route('admin.forward.inquiry', [$student->id]) }}" class="btn btn-success">Forward</a>-->
                        <!--@else-->
                    <!--<a href="{{  route('admin.shared.schedule.trial.class',$student->id) }}" class="btn btn-warning">Start Trial</a>-->
                        <!--@endif-->

                        <!--@endif-->

                        @if($student->status!="cancelled")
                            <button class="btn btn-warning" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')">Cancel</button>
                        @endif

                    </div>
                <td>
                    <a href="{{route('admin.send.payment.reminder',$student->id)}}" class="btn btn-primary">Send Reminder</a>
                </td>

                {{--             <td class="btn-group">
                                 <a class="btn btn-info text-white payment-link" data-id="{{ $student->id }}" data-mail="{{ $student->user->email }}">Payment Link</a>
                             </td>   --}}

            </tr>
        @endforeach
        </tbody>
    </table>
</div>


@include('admin.partials.table_pagination')
