<div class="table-div" style="overflow-x: auto">
    <table class="table   table-striped">
        <thead class="border">
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Main Account
                </th>
                <th>
                    Child Profile
                </th>
                <th>Email</th>
                <th>Skype ID</th>
                <th>Skype Assigned At</th>
                <th>phone</th>

                <th>Trial End Date</th>

                <th>Father Name</th>
                <th>Mother Name</th>
                <th>Assign Skype</th>
                <th>Status</th>
                <th>Action</th>
                {{--        @if (auth()->user()->role === 'admin')
                    <th>
                      Payouts
                    </th>
                    @endif --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($searchResults as $st)
                @if ($st->user == null)
                    @continue;
                @endif
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $st->user->name ?? 'N/A' }}
                    </td>
                    <td>
                        {{ $st->child->name ?? 'N/A' }}
                    </td>
                    <td>
                        {{ $st->user->email ?? 'N/A' }}
                    </td>
                    <td>
                        {{ $st->child->skype_id ?? 'N/A' }}
                    </td>
                    <td>
                        {{ isset($st?->child?->skype_assigned_at) ? \Carbon\Carbon::parse($st?->child?->skype_assigned_at)->format('Y-m-d') : 'N/A' }}

                    </td>
                    <td>
                        {{ $st->user->phone ?? 'N/A' }}
                    </td>
                    <td>{{ $st->trial_end_date }}</td>

                    <td>
                        {{ $st->user->fathername ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $st->user->mothername ?? 'N/A' }}
                    </td>
                    <td>
                        <div>
                            <button class="btn btn-info assignSkypeId" type="button"
                                data-user-id="{{ $st?->child?->id ?? 0 }}">Assign Skype</button>
                        </div>
                    </td>
                    <td>
                        @if ($st->status == 'pending')
                            <span class="badge badge-info">
                                Pending {{ $st->tutor ? '(Tutor assigned)' : 'N/A' }}
                            </span>
                        @elseif($st->status == 'started')
                            <span class="badge badge-success">Started</span>
                        @elseif($st->status == 'cancelled')
                            <span class="badge badge-danger">Cancelled</span>
                        @else
                            <span class="badge badge-warning">On Trial</span>
                        @endif
                    </td>
                    <td class="btn-group">
                        <a href="{{ route('admin.student.inquiry.detail', $st->id) }}"
                            class="btn btn-primary">Detail</a>
                        {{--                    <a href="{{route('admin.student.edit.schedule',$st->id)}}" class="btn btn-primary" title="Edit Schedule"><i class="fa fa-edit"></i> </a> --}}
                        {{--                    <button class="btn btn-danger m-0 btn-block" onclick="deleteAlert('{{route('admin.student_delete',['id'=>$st->user->id])}}')" style="margin-left:10px">Delete</button> --}}
                    </td>
                    {{--         @if (auth()->user()->role === 'admin')
                        <td>
                          <a href="{{ route('admin.student.payouts', $st->user->id) }}" class="btn btn-info btn-block">Paid Payments</a>
                        </td>
                        @endif  --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        // Select the button by its id
        var openModalButton = $('.assignSkypeId');

        // Add click event listener
        openModalButton.click(function() {
            var rowId = $(this).data('user-id');
            $('.user_id').val(rowId);
            // Show the modal
            $('.skype_modal').modal('show');
        });
    });
</script>



@include('admin.partials.table_pagination')
