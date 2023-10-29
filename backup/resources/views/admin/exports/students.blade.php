<table>
  <thead>
    <tr>
      <th>
        ID
      </th>
      <th>
        Name
      </th>
      <th>
        Email
      </th>
      <th>
        phone
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($students as $student)
    <tr>
      <td>
        {{ $loop->iteration }}
      </td>
      <td>
        {{$student->name?? ''}}
      </td>
      <td>
        {{$student->email?? ''}}
      </td>
      <td>
        {{$student->phone?? ''}}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>