@extends('payment_manager.layouts.app')
@section('content')
  <div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
  </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Active Inquiries</h4>
             
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
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
                        Status
                      </th>
                      
                      <th>
                        Inquiry
                      </th>
                      <th>
                        Action
                      </th>
                  </thead>
                  <tbody>
                    <?php $index_count = 1; ?>
                        @if(count($users)>0)
                        @foreach ($users as $user)
                        
                        <tr>
                            <td>
                                <?php echo $index_count++ ?>
                            </td>
                     <td>
                        {{$user->user->name?? ''}}
                     </td>
                     <td>
                        {{$user->user->email?? ''}}
                     </td>
                     <td>
                        {{$user->user->phone?? ''}}
                     </td>
                     <td>
                         
                        {{$user->status ?? ''}}
                     </td>
                     <td>
                        {{ \Illuminate\Support\Str::limit($user->inquiry ?? '', 100, $end='...') }}   
                        
                     </td>
                     
                     
                    
                     <td>
                        
                      
                        <a href="{{url('payment_manager/cancel/'.$user->user->id)}}"><button type="button" class="btn btn-danger btn-sm">Cancel</button>
                        
                     </td>
                   

                      </tr>
                     @endforeach
                     @else
                     <tr>
                         <td>
                             No Record
                         </td>
                     </tr>
                     @endif
                    
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        
             

@stop