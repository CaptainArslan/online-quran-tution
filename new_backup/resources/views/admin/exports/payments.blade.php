<table>
  <thead>
    <tr>
      <th>
        Tutor
      </th>
      <th>
        Manager
      </th>
      <th>
        Status
      </th>
      <th>
        Amount To Pay
      </th>
      <th>
        Amount Paid
      </th>
      <th>
        Paid At
      </th>
    </tr>
  </thead>
  <tbody>
   @isset($payments)
   @foreach ($payments as $payment)
   <tr>
    <td>
      {{$payment->tutor->name ?? ''}}
    </td>
    <td>
      {{$payment->manager->name ?? ''}}
    </td>
    <td>
      <span >{{$payment->status ?? ''}}</span>
    </td>

    <td>
      <em>{{$payment->amount_to_payment ?? ''}}</em>
    </td>
    <td>
      <strong><u>{{$payment->amount_paid ?? ''}}</u></strong>
    </td>
    <td>
      {{$payment->paid_at ?? ''}}
    </td>
  </tr>
  @endforeach
  @endisset
</tbody>
</table>