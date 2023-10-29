<table>
    <thead>
        <tr>
            <th>
              #
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
    @foreach ($tutors as $tutor)
    <tr>
        <td>
          {{ $loop->iteration }}
      </td>
      <td>
          {{$tutor->name ?? ''}}
      </td>
      <td>
          {{$tutor->email ?? ''}}
      </td>
      <td>
          {{$tutor->phone ?? ''}}
      </td>
  </tr>
  @endforeach
</tbody>
</table>