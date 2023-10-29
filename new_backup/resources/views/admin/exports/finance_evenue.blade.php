<table>
  <thead>
    <tr>
     <th>
      #
    </th>
    <th>
      Summary
    </th>
    <th>
      Amount
    </th>
    <th>
      Date
    </th>
  </tr>
</thead>
<tbody>
  @foreach ($revenues as $revenue)
  <tr>
    <th>{{ $loop->iteration }}</th>
    <td>Paid via {{ $revenue->method ?? 'N/A' }} Payment Systems</td>
    <td><em><strong>&pound;{{ $revenue->amount  ?? '0' }}</strong></em></td>
    <td>{{$revenue->created_at->todatestring() ?? 'N/A'}}</td>
  </tr>
  @endforeach
</tbody>
</table>