@extends('layouts.app')
@section('css')
<style>
    
    .btn-gocardless, .btn-gocardless:hover{
        background: #0854B3 !important;
        color: #fff !important;
        border-radius: 0 !important;
        font-weight: normal;
        padding: 10px 40px;
        font-size: 24px;
    }
</style>
@endsection
@section('content')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <section class="section-lesson">
        <div class="container mt-4 mb-4" id="gocardless-description">
            <div class="card" style="box-shadow: 0px 0px 49px -32px rgba(0,0,0,0.70); border:none;">
                <div class="text-center p-3">
                    <h2 class="text-success">Payments via Go Cardless</h2>
                    <h6>Go Cardless Payments protected under the Direct Debit Guarantee</h6>
                </div>
                <hr class="p-0 m-0"/>
                <div class="card-body">
                    <p>The Direct Debit Guarantee protects your customers against payments made in error or fraudulently,
                        making Direct Debit the UK’s safest payment method.</p>
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
                        GoCardless (company registration number 07495895) is authorised by the Financial Conduct Authority under the Payment Services Regulations 2017, registration number 597190, for the provision of payment services.
                        </small>
                        <div class="text-center mt-2">
                            <a href="{{ route('student.payments.index', $id) }}" class="btn btn-lg btn-gocardless">PROCEED NEXT</a>
    
                            <div class="pt-1">have any issue in paymetns? <a href="" class="font-weight-bold">click here</a> to contact</div>
                        </div>
                </div>
              </div>
        </div>
    </section>
</div>
@endsection