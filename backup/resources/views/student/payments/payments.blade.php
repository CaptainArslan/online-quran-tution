@extends("student.layouts.app")
@section('css')
<style>
.plan-card {
cursor: pointer;
max-height: 450px;
}
.active-plan {
border: 2px solid #272D1C;
opacity: 0.6;
}
.fa-check-square{
color: #28C76F;
padding: 5px;
}
.plan-card {
cursor: pointer;
max-height: 450px;
}
.active-plan {
border: 1px solid #272D1C;
opacity: 0.7;
}
.btn-gocardless, .btn-gocardless:hover{
background: #0854B3 !important;
color: #fff !important;
border-radius: 0 !important;
padding: 10px;
font-weight: bold;
}
.btn-paypal{
background: #F7BF36 !important;
color: #10297E !important;
border-radius: 0 !important;
padding: 10px;
font-weight: bold;
}
.nav-tabs .active{
border: 3px solid #000 !important;
}
</style>
@endsection
@section('content')
@include('admin.partials.success_message')
@section('topbar-heading', 'Pay Inquiry')
<div class="col-12">
    <div class="text-center">
        <h2>Select Plan and Proceed to Payments</h2>
        <hr/>
    </div>
</div>


<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active pb-1" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

        
            
            <div class="row">
                @foreach(indexPlansPrivate() as $pl)
                
                <div class="col-md-6 col-sm-6">
                    <div class="card plan-card" data-plan="{{ $pl->id }}">
                        <ul class="list-group list-group-flush text-center">
                            <li  class="list-group-item"><h2>{{$pl->name}}</h2></li>
                        </ul>
                        <div class="text-center bg-success text-white p-1">
                            @if($pl->discount == 0)
                            <h3 class="text-white font-weight-bold pb-0 mb-0">{{ $pl->country->currency }}{{$pl->price_per_month ?? ''}} Price Per Month </h3>
                            @else
                            <h4 class="text-white font-weight-bold"><strike>Start from {{ $pl->country->currency }} {{$pl->price}}</strike> </h4>
                            <h3 class="text-white font-weight-bold">Discount Price</h3>
                            <h1 class="text-white font-weight-bold">{{ $pl->country->currency }} @php echo $discounted_price = $pl->price - $pl->discount;  @endphp</h1>
                            @endif

                        </div>
                        <ul class="list-group list-group-flush">
                            <li  class="list-group-item"><i class="fa fa-check-square"></i>{{$pl->days_in_week ?? ''}} Days in Week</li>
                            <li  class="list-group-item"><i class="fa fa-check-square"></i>{{$pl->classes_in_month ?? ''}} Classes in Month</li>
                            <li  class="list-group-item"><i class="fa fa-check-square"></i>{{$pl->duration ?? ''}} Duration</li>
                        </ul>
                        
                    </div>
                </div>
                @endforeach
            </div>
            
            
            


          
    </div>

             

        </form>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Payments via Go Cardless</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('student.payments.create') }}" method="POST">
        
        @csrf
        <input type="hidden" name="inquiry_id" value="{{ $id }}">
        <input id="plan_id" name="plan_id" type="hidden">
        
        <div class="container p-0" id="gocardless-description">
            
            <div class="card-body pt-0">
                <p><strong>Go Cardless Payments protected under the Direct Debit Guarantee</strong>The Direct Debit Guarantee protects your customers against payments made in error or fraudulently,
                    making Direct Debit the UKs safest payment method.</p>
                    <div>
                        <img src="{{ asset('images/gocardless.jpg') }}" class="img-fluid" alt="gocardless">
                    </div>
                    <a href="https://gocardless.com/direct-debit/guarantee/" target="_blank" class="btn pl-0 pt-2 text-info">https://gocardless.com/direct-debit/guarantee/</a>
                    <h4 class="bg-info text-white p-1">From individuals to multi-national corporations,
                        GoCardless helps thousands of businesses with their payments everyday.
                    <a href="https://gocardless.com/stories/" class="text-dark" target="_blank">https://gocardless.com/stories</a>
                    </h4>

                    <div class="mt-2">
                        <h3>Fully safe and secure</h3>
                        <p>GoCardless is authorised by the Financial Conduct Authority, and ISO27001 certified for security standards.</p>

                    </div>
            </div>
            <div class="card-footer">
                <small>GoCardless Ltd., Sutton Yard, 65 Goswell Road, London, EC1V 7EN, United Kingdom
                    GoCardless (company registration number 07495895) is authorised by the Financial Conduct Authority under the Payment Services Regulations 2017, registration number 597190, for the provision of payment services.<br/>If you have any issue in paymetns with GoCardLess? <a href="{{ route('index') }}" class="font-weight-bold">click here</a> to contact.</div>
                    </small>
                    
            </div>
            
            <!--PROMO CODE DIV-->
        <div class="row mb-2 pt-2">
                <div class="col-sm-12 mb-2">
                    <a class="font-weight-bold text-dark promo-code-section" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><u>Have a promo code?</u></a>
                    <div class="collapse" id="collapseExample">
                        <label class="text-danger" id="response-msg"></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="promo" name="promo" placeholder="promo code e.g. MBL350" onkeyup="this.value = this.value.toUpperCase();">
                            <div class="input-group-prepend">
                                <a class="btn btn-success apply-coupan-btn">Apply</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <h4 class="alert alert-success" id="succes-discount-value" style="display: none;">
                    Promo Validated! Your Selected Plan Price is now! <span id="value-internal"></span>
                </h4>
            </div> 
        <!--END PROMO CODE DIV-->
        
        
        
         <div class="text-center mb-1">
            <div id="gocardless-continue-btn">
                <button class="btn btn-lg btn-gocardless p-1" type="submit">PROCEED TO PAYMENTS</button>
            </div>
        </div>
        </form>
            
      </div>
        
        
        
      
    </div>
  </div>
</div>

@section('js')
<script>


$('.plan-card').click(function() {
    
    $plan_id = $(this).data('plan');
    $('#plan_id').val($plan_id);
    
    $('#exampleModalCenter').modal('show');
    
    $('.active-plan').removeClass('active-plan');
    
        $(this).addClass('active-plan').find('input').prop('checked', true);
    
    });


</script>


<script>
$('.apply-coupan-btn').click(function() {
$(this).text('Applying...');
var plan_id = $('#plan_id').val();
if (plan_id == "") {
return false;
}
var promo_code = $('#promo').val();
$.ajax({
type: "GET",
url: "{{ route('validate.promo') }}",
data: {
promo: promo_code,
plan_id: plan_id
}
}).done(function(data) {
if (data.error) {
$('#response-msg').show().html(data.error);
$('.apply-coupan-btn').text('Apply');
$('#succes-discount-value').css('display', 'none');
} else {
console.log(data.discount);
$('#response-msg').hide();
$('#succes-discount-value').css('display', 'block');
$('#value-internal').html(data.discount);
$('.apply-coupan-btn').text('Apply');
}
});
});
</script>

@endsection
@stop
