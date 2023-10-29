<div class="table-div" style="overflow-x: auto">
    <table class="table   table-striped" >
        <thead class="border">
        <th>
            ID
        </th>
        <th>
            Student Name
        </th>
        <th>
            Student Email
        </th>
        <th>
            Student Phone
        </th>
        <th>
            Created
        </th>
        </thead>
        <tbody>
        @foreach ($searchResults as $student)

            @if($student->user)
                @php $diff = \Carbon\Carbon::now()->diffInDays($student->created_at); @endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$student->user->name ?? ''}}</td>
                    <td>{{$student->user->email ?? 'N/A'}}</td>
                    <td>{{$student->user->phone ?? ''}}</td>
                    <td>{{$student->created_at->diffForHumans() ?? "N/A" }}</td>
                </tr>
            @endif




        @endforeach
        </tbody>
    </table>
</div>




@include('admin.partials.table_pagination')
