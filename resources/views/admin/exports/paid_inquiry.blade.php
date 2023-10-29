<table>
    <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                Student Name
            </th>
            <th>
                Email
            </th>
            <th>Phone</th>
            <th>Tutor Name</th>
            <th>
                Inquiry Status
            </th>
            <th>Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($paidInquirys as $student)
        @if(!empty($student->user))
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$student->user->name ?? ''}}
            </td>
            <td>
                {{$student->user->email ?? ''}}
            </td>
            <td>
                {{$student->user->phone ?? ''}}
            </td>
            <td>{{$student->tutor->name ?? "N / A"}}</td>
            <td>
                @if($student->status=="pending")
                <span >
                    Pending {{ $student->tutor ? '(Tutor assigned)' : '' }}
                </span>
                @elseif($student->status=="started")
                <span >Started</span>
                @elseif($student->status=="cancelled")
                <span >Cancel</span>
                @else
                <span >On Trial</span>
                @endif
            </td>
            <td>
                {{$student->created_at ?? ""}}
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>