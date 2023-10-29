<table>
    <thead>
        <tr>
            <th>
              #
          </th>
          <th>
              Tutor
          </th>
          <th>
              Time
          </th>
          <th>
            created
          </th>
      </tr>
  </thead>
  <tbody>
    @foreach ($schedules as $schedule)
    <tr>
        <td>
          {{ $loop->iteration }}
      </td>
      <td>
          {{ App\Models\User::where('id',$schedule->tutor_id)->pluck('name') ?? ''}}
      </td>
      <td>
          {{$schedule->time ?? ''}}
      </td>
      <td>
          {{$schedule->created_at ?? ''}}
      </td>
  </tr>
  @endforeach
</tbody>
</table>