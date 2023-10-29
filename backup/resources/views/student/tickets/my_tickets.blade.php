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

    <section class="relative no-top no-bottom " data-bgimage="" data-stellar-background-ratio=".2"  id="basic-datatable">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration table-hover">
                                        <thead>
                                            <tr>
                                                <th>Enquiry Type</th>
                                                <th>Subject</th>
                                                <th>Status</th>
                                                <th>Last Updated</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>

                                            @foreach ($tickets as $item)
                                            <tbody>
                                                <td>{{ $item->enquiry_type }}</td>
                                                <td>
                                                    <span class="font-weight-bold text-primary" style="display: block;font-style:italic;">#{{ $item->ticket_id }}</span>
                                                    {{ $item->subject }}
                                                </td>
                                                <td>
                                                    @if ($item->status == "open")
                                                    <div class="chip chip-success">
                                                        <div class="chip-body">
                                                            <div class="chip-text text-white font-weight-bold">open</div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="chip bg-grey">
                                                        <div class="chip-body">
                                                            <div class="chip-text text-info font-weight-bold">closed</div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('student.ticket.tickets.detail', $item->ticket_id) }}" class="btn btn-primary pull-right">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                                    </a>
                                                </td>
                                            </tbody>
                                            @endforeach
                                    </table>
                                </div>
                            </div>
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


