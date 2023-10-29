<table>
  <thead>
    <tr>
      <th>
        #
      </th>
      <th>
        Date
      </th>
      <th width="40%">
        Description
      </th>
      <th>
        Amount
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($expenses as $expense)
    <tr>
      <td>
        {{ $loop->iteration }}
      </td>
      <td>
        {{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}
      </td>
      <td>
        {{ $expense->description ?? 'N/A' }}
      </td>
      <td>
        <strong><em>Rs {{$expense->amount ?? ''}}</em></strong>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>