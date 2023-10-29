

<div class="table-div" style="overflow-x: auto">
    <table class="table   table-striped" >
        <thead class="border">
        <th>
            ID
        </th>
        <th>
            Main Account
        </th>
        <th>
            Child
        </th>
        <th>
            Mobile
        </th>
        <th>
            Email
        </th>
        <th>
            Skype ID
        </th>
        <th>Tutor Name</th>
        <th>Tutor Email</th>
        <th>Tutor Phone</th>
        <th>Trial Start</th>
        <th>
            Inquiry Status
        </th>
        <th>
            Action
        </th>
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
                    <a href="{{--@if($student->status!=='pending') {{route('admin.student.edit.schedule',$student->id)}} @else # @endif --}}#" title="Edit Schedule"> {{$student->user->name ?? 'N / A'}}</a>
                </td>
                <td>
                    {{$student->child->name ?? 'N / A'}}
                </td>
                <td>
                    {{$student->user->phone ?? 'N / A'}}
                </td>
                <td>
                    {{$student->user->email ?? 'N / A'}}
                </td>
                <td>
                    {{$student->user->skype_id ?? 'N / A'}}
                </td>
                <td>@if(!empty($student->tutor)) {{$student->tutor->name ?? ''}} @endif</td>
                <td>@if(!empty($student->tutor)) {{$student->tutor->email ?? ''}} @endif</td>
                <td>@if(!empty($student->tutor)) {{$student->tutor->phone ?? ''}} @endif</td>
                <td>{{$student->trial_start}}</td>
                <td width="20%">
                    @if($student->status=="pending")
                        <span class="badge badge-info">
                                        Pending {{ $student->tutor ? '(Tutor assigned)' : '' }}
                                    </span>
                    @elseif($student->status=="started")
                        <span class="badge badge-success">Started</span>
                    @elseif($student->status=="cancelled")
                        <span class="badge badge-danger">Cancelled</span>
                    @else
                        <span class="badge badge-warning">On Trial</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group">


                        <a href="{{route('admin.inquiry.detail',[$student->id])}}" class="btn btn-primary">Detail</a>


                    <!--@if($student->status=="on_trial")-->
                    <!--<a href="{{ route('admin.change.inquiry.status', [$student->id, 'started']) }}" class="btn btn-success">Start</a>-->
                    <!--@elseif($student->status=="pending")-->

                    <!--@if(is_null($student->tutor_id))-->
                    <!--<a href="{{ route('admin.forward.inquiry', [$student->id]) }}" class="btn btn-success">Forward</a>-->
                        <!--@else-->
                    <!--<a href="{{ route('admin.shared.schedule.trial.class',$student->id) }}" class="btn btn-warning">Start Trial</a>-->
                        <!--@endif-->

                        <!--@endif-->

                    <!--@if($student->status!="cancelled")-->
                    <!--<button type="button" class="btn btn-danger" onclick="deleteAlert('{{ route('admin.change.inquiry.status', [$student->id, 'cancelled']) }}')">Cancel</button>-->
                        <!--@endif-->
                        <button type="button" class="btn btn-dark" onclick="deleteAlert('{{ route('admin.inquiry.delete', $student->id) }}')">Delete</button>

                    </div>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>


@include('admin.partials.table_pagination')
