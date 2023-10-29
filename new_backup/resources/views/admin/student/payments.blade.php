@extends('admin.layouts.app')
@section('title',$student->name)

@section('content')

<div class="row mt-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title text-uppercase"><span class="text-success">{{ $student->name }}</span> Payouts</h4>

        <span class="pull-right badge badge-success" style="font-size: 24px; font-weight: bold;">Total Paid: &#163;{{ $payouts->sum('amount') }}</span>

      </div>
      <div class="card-body">

          <div class="row mb-3">
              <div class="col-md-6">
                  <h5><span class="font-weight-bold"> Email :</span>&nbsp;&nbsp; {{$student->email}}</h5>
              </div>
              <div class="col-md-6">
                  <h5><span class="font-weight-bold">Phone :</span>&nbsp;&nbsp; {{$student->phone}}</h5>
              </div>
              
              @if(count($payouts) > 0 && $payouts->last()->method == 'gocardless' && $payouts->last()->status =='active')
              <div class="col-md-12 mt-2 text-right">
                  <button class="btn btn-info add-plan" id="add-plan">Add new plan</button>
                  <button class="btn btn-primary cancel-sub" data-subscription={{$payouts->last()->subscription_id}}>Cancel Subscription</button>
              </div>
              @elseif(count($payouts) > 0 && $payouts->last()->method == 'gocardless' && $payouts->last()->status =='cancelled')
                <div class="col-md-12 mt-2 text-right">
                    <button class="btn btn-info add-plan" id="add-plan">Add new plan</button>
                  <button class="btn btn-primary create-sub" data-subscription={{$payouts->last()->subscription_id}}>Create Subscription</button>
              </div>
              @endif
          </div>
          <hr>
          <div class="row">
          @forelse($payouts as $payout)

            <div class="col-sm-4">
                <div class="card" style="border: 2px solid;">
                    <div class="card-body text-center">
                      <h5 class="card-title">Subscription</h5>
                      <hr>
                      <h3 class="card-subtitle mb-2 text-muted text-uppercase">{{$payout->method}}</h3>
                      <p class="card-text">Created: {{ $payout->created_at->diffForHumans() ?? '' }}</p>
                      <a href="{{ route('admin.get.subscription.detail', $payout->id) }}" class="btn btn-lg btn-success">View detail</a>
                    </div>
                  </div>
            </div>

          @empty
            <div class="col-sm-12 text-center">
                <h2 class="alert alert-danger">No Payments {{ $student->name }} were found.</h2>
            </div>
          @endforelse
        </div>

      </div>
    </div>
  </div>
</div>



         <!-- The Modal -->
  <div class="modal fade create-subscription" id="myModal">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create  new plan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="{{route('admin.create.new.subscription')}}" method="post">
            @csrf
            <input type="hidden" name="subscription_id" id="sub_id">
            <!-- Modal body -->
            <div class="modal-body">
             <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group">
                         <label>Select Plan</label>
                         <select name="plan_id" class="form-control" required>
                             <option disabled selected value="">Select</option>
                             @foreach(indexPlans() as $pl)
                             @if($pl->discount == 0)
                                <option value="{{$pl->id}}">{{$pl->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $pl->country->currency }}{{$pl->price_per_month}}</option>
                            @else
                                <option value="{{$pl->id}}">{{$pl->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $pl->country->currency }}{{$pl->price}}</option>
                            @endif
                             @endforeach
                         </select>
                     </div>
                 </div>
                 
                 <div class="col-sm-12">
                     <div class="form-group">
                         <label>Subscription Start Date</label>
                         <input type="text" name="start_date" class="form-control datepicker" id="date">
                     </div>
                 </div>
                 
                 
             </div>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>




    <div class="modal fade" id="createPrivatePlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add a private plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form class="form" action="{{route('admin.private_plan')}}" method="post">
            <div class="modal-body">
      
                            @csrf
                             <input type="hidden"   name="is_private" value="1" >
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Name" name="name" required  value="{{ old('name') }}">
                                            <label for="first-name-column">Name</label>
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <select id="" class="form-control selectpicker"  required  data-live-search="true"
                                                name="country_id">  
                                                <option disabled selected value="">Select Country</option>
                                                @foreach($country as $c)        
                                                <option value="{{$c->id}}" {{ old('country_id') == $c->id ? 'selected' : '' }}>{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="last-name-column">Country</label>
                                            @error('country_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Price" name="price"  required  value="{{ old('price') }}">
                                            <label for="last-name-column">Price</label>
                                            @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="number" min="0" id="city-column" class="form-control"
                                                placeholder="Discount"  required  name="discount" value="{{ old('discount') }}">
                                            <label for="city-column">Price after discount</label>
                                            @error('discount')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="country-floating" class="form-control" value="{{ old('days_in_week') }}"
                                                name="days_in_week"  required  placeholder="No. of days in week">
                                            <label for="country-floating">Days_in_week</label>
                                            @error('days_in_week')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="company-column" class="form-control"
                                                name="classes_in_month"  required  value="{{ old('classes_in_month') }}" placeholder=" No. classes in month">
                                            <label for="company-column">classes_in_month</label>
                                            @error('classes_in_month')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="company-column"  required  class="form-control" name="duration"
                                                value="{{ old('duration') }}" placeholder="Duration">
                                            <label for="company-column">Duration</label>
                                            @error('duration')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="number" min="0" id="company-column" class="form-control"
                                                name="price_per_month"  required  value="{{ old('price_per_month') }}" placeholder="Price Per Month">
                                            <label for="company-column">price per month</label>
                                            @error('price_per_month')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="text"  required  id="company-column" class="form-control" name="note"
                                                value="{{ old('note') }}" placeholder="Note">
                                            <label for="company-column">note</label>
                                            @error('note')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div> 
            </div>
      <div class="modal-footer">
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-danger" href="{{route('admin.plan_list')}}">Cancel</a>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>




@stop
@section('js')


<script>
    $(document).ready(function(){
        $('.add-plan').click(function(){
            $('#createPrivatePlan').modal('show');
        });
       $('.cancel-sub').click(function(){
           let subscription=$(this).data('subscription');
           let url='{{route('admin.cancel.subscrip')}}?id='+subscription;
           Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = url;
                  }
                  else{
                      Swal.fire(
                      'Saved!',
                      'Subscription is safe.',
                      'success'
                    )
                  }
            })
           
           
       }) ;
    });
    
    $(document).ready(function(){
       $('.create-sub').click(function(){
           let subscription_id=$(this).data('subscription');
           $('#sub_id').val(subscription_id);
           $('.create-subscription').modal('show');
       }) ;
    });
</script>



@endsection
