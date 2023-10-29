<table>
    <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                Student Name
            </th>
            <th>Tutor Name</th>
            <th>
                Email
            </th>
            <th>
                Phone
            </th>
            <th>
                Created
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cancel_subs as $student)
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$student->user->name ?? ''}}
            </td>
            <td>
                @if(!empty($student->tutor->name))
                {{$student->tutor->name ?? ""}}
                @else
                N / A
                @endif
            </td>
            <td>
                {{$student->user->email ?? ''}}
            </td>
            <td>
                {{$student->user->phone ?? 'N / A'}}
            </td>
            <td>
                {{$student->created_at ?? ""}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>