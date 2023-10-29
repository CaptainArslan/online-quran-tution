@extends("student.layouts.app")
@section('css')
<style>
    .mce-notification-inner,.mce-close,.mce-notification {display:none!important;}
</style>
@endsection
@section('content')
@include('admin.partials.success_message')
@section('topbar-heading', 'Open Support Order')

<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section class="relative no-top no-bottom " data-bgimage="" data-stellar-background-ratio=".2">

       <div class="container mb-5 p-0">
            <div class="card">
                <div class="card-body">
                    <div class="card-content">
                        <form action="{{ route('student.ticket.save_ticket') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-float-label">
                                        <div class="controls">
                                            <label for="enquiry_type">Enquiry Type</label>
                                            <select id="enquiry_type" class="form-control" name="enquiry_type" required>
                                                <option value="Support" selected hidden>Select Enquiry Type</option>
                                                <option value="Support">Support</option>
                                                <option value="Inquiry">Inquiry</option>
                                                <option value="Billing">Billing</option>
                                                <option value="Abuse">Abuse</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-float-label">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control required" id="subject" value="" placeholder=" e.g payment issues, inquiry problem" name="subject" autocomplete="off">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-float-label">
                                        <div class="controls">
                                            <label for="priority">Priority</label>
                                            <select id="priority" class="form-control" name="priority" required>
                                                <option value="medium" selected hidden>Select Priority</option>
                                                <option value="high">High</option>
                                                <option value="medium">Medium</option>
                                                <option value="low">Low</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12"><label for="textarea-counter">Detailed Message</label>
                                    <textarea data-length="20" class="form-control char-textarea" placeholder="Description" id="textarea-counter" rows="5" name="description"></textarea>

                                </div>
                            </div>
                            <div class="mt-4"></div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

       </div>

    </section>
    <!-- section close -->

</div>
<!-- content close -->
<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5g5faf78gvk6yfq9bd3bbfjo858kjx1q8o0nbiwtygo2e4er'></script>
<script>tinymce.init({selector:'textarea'});</script>
@stop


