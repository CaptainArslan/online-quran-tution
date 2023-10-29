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
    @foreach ($expenses as $expense)
    <tr>
      <th>{{ $loop->iteration }}</th>
      <td>{{ Str::limit($expense->admin_note ?? 'N/A', 35) }}</td>
      <td><em><strong>&pound;{{ $expense->amount_paid  ?? '0' }}</strong></em></td>
      <td>{{ $expense->paid_at ?? 'N/A' }}</td>
    </tr>
    @endforeach
  </tbody>
</table>