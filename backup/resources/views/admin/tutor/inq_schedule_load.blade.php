<div class="table-responsive">
  <table class="table table-bordered table-hover ">
    <thead>
    </thead>
    <tbody class="mt-4">
      <tr>
        <th scope="row">Student Name</th>
        <td>{{$inquiry_schedule->inquiry->user->name ?? "N / A"}}</td>
      </tr>
      <tr>
        <th scope="row">Tutor Name</th>
        <td>{{$inquiry_schedule->inquiry->tutor->name ?? 'N / A'}}</td>
      </tr>
      <tr>
        <th scope="row">Status</th>
        <td>{{$inquiry_schedule->inquiry->status ?? 'N / A'}}</td>
      </tr>
      <tr>
        <th scope="row">Inquiries</th>
        <td>{{$inquiry_schedule->inquiry->inquiry ?? 'N / A'}}</td>
      </tr>
      <tr>
        <th scope="row">Days</th>
        <td scope="row">
          @if($inquiry_schedule->day==1)
          Monday
          @elseif($inquiry_schedule->day==2)
          Tuesday
          @elseif($inquiry_schedule->day==3)
          Wednesday
          @elseif($inquiry_schedule->day==4)
          Thurdsday
          @elseif($inquiry_schedule->day==5)
          Friday
          @elseif($inquiry_schedule->day==6)
          Saturday
          @else
          Sunday
          @endif
        </td>
      </tr>
      <tr>
        <th scope="row">Time</th>
        <td>{{ $inquiry_schedule->time ?? '' }}</td>
      </tr>
    </tbody>
  </table>
</div>