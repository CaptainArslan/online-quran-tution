@extends('admin.layouts.app')
@section('title', 'Email Notifications')
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
@section('content')
{{-- <div class="col-12">
<div class="toast">
    <div class="toast-header">
        Email Notification
    </div>
    <div class="toast-body">
        Email On
    </div>
</div>
</div> --}}
<div class="col-12">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>

<div class="content-header row">
</div>
<div class="content-body">
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-md-6" style="width:800px; margin:0 auto;">
                <div class="card">

                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Email Notifications</h4>
                    </div>
                    <div class="card-body">


                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <p>Mail To Admin On Inquiry:</p>
                                    </div>

                                    <div class="position-relative has-icon-left">
                                        <label class="switch">
                                            <input type="checkbox"
                                                value="{{ $allow_mails->inquiry_mail_to_admin ?? '1' }}"
                                                mail_to="inquiry_mail_to_admin" class="allow-mail" {{ $allowed_mails->inquiry_mail_to_admin ?? '1' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                        {{-- <div
                                            class="custom-control custom-switch custom-switch-info mr-2 mb-1  ">

                                            <input type="checkbox" value="{{ $allow_mails->inquiry_mail_to_admin ?? '1' }}"
                                        mail_to="inquiry_mail_to_admin" class="custom-control-input allow-mail"
                                        id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1"></label>
                                    </div> --}}

                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <p>Mail Student On Enrollment</p>
                                </div>

                                <div class="position-relative has-icon-left">

                                    <label class="switch">
                                        <input type="checkbox" value="{{ $allow_mails->cred_mail_to_student ?? '1' }}"
                                            mail_to="cred_mail_to_student" class="allow-mail"
                                            {{ $allowed_mails->cred_mail_to_student ?? '1' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    {{-- <div class="custom-control custom-switch custom-switch-info mr-2 mb-1">

                                            <input type="checkbox" value="{{ $allow_mails->cred_mail_to_student ?? '1' }}"
                                    mail_to="cred_mail_to_student" class="custom-control-input allow-mail"
                                    id="customSwitch2">
                                    <label class="custom-control-label" for="customSwitch2"></label>
                                </div> --}}

                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <p>Mail Tutor on Student Appointment</p>
                            </div>

                            <div class="position-relative has-icon-left">

                                <label class="switch">
                                    <input type="checkbox" value="{{ $allow_mails->appointment_mail_to_tutor ?? '1' }}"
                                        mail_to="appointment_mail_to_tutor" class="allow-mail"
                                        {{ $allowed_mails->appointment_mail_to_tutor ?? '1' ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                                {{-- <div class="custom-control custom-switch custom-switch-info mr-2 mb-1">

                                            <input type="checkbox" value="{{ $allow_mails->appointment_mail_to_tutor ?? '1' }}"
                                mail_to="appointment_mail_to_tutor" class="custom-control-input allow-mail"
                                id="customSwitch3">
                                <label class="custom-control-label" for="customSwitch3"></label>
                            </div> --}}

                        </div>

                    </div>
                </div>
                {{-- <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <p>Mail Student When Trial Starts:</p>
                                    </div>

                                    <div class="position-relative has-icon-left">


                                        <div class="custom-control custom-switch custom-switch-info mr-2 mb-1">

                                            <input type="checkbox" value="1" class="custom-control-input allow-mail" id="customSwitch4">
                                            <label class="custom-control-label" for="customSwitch4"></label>
                                        </div>

                                    </div>

                                </div>
                            </div> --}}
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <p>Student Mail On Tutor Appointment:</p>
                        </div>

                        <div class="position-relative has-icon-left">

                            <label class="switch">
                                <input type="checkbox" value="{{ $allow_mails->appointment_mail_to_student ?? '1' }}"
                                    mail_to="appointment_mail_to_student" class="allow-mail"
                                    {{ $allowed_mails->appointment_mail_to_student ?? '1' ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                            {{-- <div class="custom-control custom-switch custom-switch-info mr-2 mb-1">

                                            <input type="checkbox" value="{{ $allow_mails->appointment_mail_to_student ?? '1' }}"
                            mail_to="appointment_mail_to_student" class="custom-control-input allow-mail"
                            id="customSwitch4">
                            <label class="custom-control-label" for="customSwitch4"></label>
                        </div> --}}

                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="form-group row">
                    <div class="col-md-8">
                        <p>Mail Tutor When trial Starts</p>
                    </div>

                    <div class="position-relative has-icon-left">

                        <label class="switch">
                            <input type="checkbox" value="{{ $allow_mails->on_trial_mail_to_tutor ?? '1' }}"
                                mail_to="on_trial_mail_to_tutor" class="allow-mail"
                                {{ $allowed_mails->on_trial_mail_to_tutor ?? '1' ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                        {{-- <div class="custom-control custom-switch custom-switch-info mr-2 mb-1">

                                            <input type="checkbox" value="{{ $allow_mails->on_trial_mail_to_tutor ?? '1' }}"
                        mail_to="on_trial_mail_to_tutor" class="custom-control-input allow-mail" id="customSwitch5">
                        <label class="custom-control-label" for="customSwitch5"></label>
                    </div> --}}

                </div>

            </div>
        </div>
        {{-- <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <p>Mail Admin on Trial Start</p>
                                    </div>

                                    <div class="position-relative has-icon-left">


                                        <div class="custom-control custom-switch custom-switch-info mr-2 mb-1">

                                            <input type="checkbox" value="1" class="custom-control-input allow-mail" id="customSwitch5">
                                            <label class="custom-control-label" for="customSwitch5"></label>
                                        </div>

                                    </div>

                                </div>
                            </div> --}}
        <div class="col-12">
            <div class="form-group row">
                <div class="col-md-8">
                    <p>Session Started Mail To Tutor(When Trial Ends)</p>
                </div>

                <div class="position-relative has-icon-left">

                    <label class="switch">
                        <input type="checkbox" value="{{ $allow_mails->start_mail_to_tutor ?? '1' }}"
                            mail_to="start_mail_to_tutor" class="allow-mail"
                            {{ $allowed_mails->start_mail_to_tutor ?? '1' ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                    {{-- <div class="custom-control custom-switch custom-switch-info mr-2 mb-1">

                                            <input type="checkbox" value="{{ $allow_mails->start_mail_to_tutor ?? '1' }}"
                    mail_to="start_mail_to_tutor" class="custom-control-input allow-mail" id="customSwitch6">
                    <label class="custom-control-label" for="customSwitch6"></label>
                </div> --}}

            </div>

        </div>
</div>
<div class="col-12">
    <div class="form-group row">
        <div class="col-md-8">
            <p>Mail Tutor On Payment</p>
        </div>

        <div class="position-relative has-icon-left">

            <label class="switch">
                <input type="checkbox" value="{{ $allow_mails->tutor_salary_mail ?? '1' }}" mail_to="tutor_salary_mail"
                    class="allow-mail" {{ $allowed_mails->tutor_salary_mail ?? '1' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
            {{-- <div class="custom-control custom-switch custom-switch-info mr-2 mb-1">

                                            <input type="checkbox" value="{{ $allow_mails->tutor_salary_mail ?? '1' }}"
            mail_to="tutor_salary_mail" class="custom-control-input allow-mail" id="customSwitch7">
            <label class="custom-control-label" for="customSwitch7"></label>
        </div> --}}

    </div>

</div>
</div>
</div>

</div>
</div>
</div>
</div>
</section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
          $(".allow-mail").click(function(){
            var mail_to = ( $(this).attr("mail_to"));
            // alert(mail_to);
            if ($(this).val() == "1") {
                // alert($(this).val())
                $(this).val("0");


            } else {
                // alert($(this).val())
                $(this).val("1");
            }
            var allow_mail = ($(this).val());


            jQuery.ajax({
                url: "{{ route('admin.notifications.allow.mail') }}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:'1',
                    allowed_mail:allow_mail,
                    mail_to :mail_to
                    },
                     success: function(data){

      if (data.error) {
				console.log(data.error.msg);
				  alert('OOPS! A Problem Occurs!');
                      }else{
                        // alert(data.success)
                        // $(".toast").toast({ delay: 3000 });
                        // $('.toast').toast('show');

                    }
                }

            });
        });
    });

</script>
@endsection
@section('css')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
@endsection
