<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Status</th>
      <th>Amount Paid</th>
      <th>Amount To Pay</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach($tutor_payout as $item)
    <tr>
      <td>{{$item->tutor->name ?? ""}}</td>
      <td>
        {{$item->status ?? ''}}
      </td>
      <td>
        {{$item->amount_paid ?? ''}}
      </td>
      <td>{{$item->amount_to_pay ?? ""}}</td>
      <td>
        {{$item->created_at ?? ''}}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>