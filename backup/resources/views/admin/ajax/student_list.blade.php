

<div class="table-div" style="overflow-x: auto">
    <table class="table   table-striped" >
        <thead class="border">
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
            <th>
                Father Name
            </th>
            <th>
                Mother Name
            </th>
            <th>Member Since</th>

            <th>
                Action
            </th>
            {{--        @if(auth()->user()->role==="admin")
                    <th>
                      Payouts
                    </th>
                    @endif --}}
        </tr>
        </thead>
        <tbody>
        @foreach ($searchResults as $st)
            @if($st->user == null)

                @continue;
            @endif
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{$st->user->name?? ''}}
                </td>
                <td>
                    {{$st->user->email?? ''}}
                </td>
                <td>
                    {{$st->user->phone?? ''}}
                </td>
                <td>
                    {{$st->user->fathername?? ''}}
                </td>
                <td>
                    {{$st->user->mothername?? ''}}
                </td>
                <th>{{date('d/m/Y',strtotime($st->created_at))}}</th>

                <td class="btn-group">
                    <a href="{{route('admin.student.inquiry.detail',$st->id)}}" class="btn btn-primary">Detail</a>
                    {{--                    <a href="{{route('admin.student.edit.schedule',$st->id)}}" class="btn btn-primary" title="Edit Schedule"><i class="fa fa-edit"></i> </a>--}}
                    <button class="btn btn-danger m-0 btn-block" onclick="deleteAlert('{{route('admin.student_delete',['id'=>$st->user->id])}}')" style="margin-left:10px">Delete</button>
                </td>
                {{--         @if(auth()->user()->role==="admin")
                        <td>
                          <a href="{{ route('admin.student.payouts', $st->user->id) }}" class="btn btn-info btn-block">Paid Payments</a>
                        </td>
                        @endif  --}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>



@include('admin.partials.table_pagination')
