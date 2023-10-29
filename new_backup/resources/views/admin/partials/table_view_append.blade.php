<div class="overlay-bg d-none"></div>
<div class="row">
    <div class="col-lg-6 mb-2">
        <span>Show </span>
        <select name="table_length_limit" class="table_length_limit">
            <option value="15">15</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span>entries</span>
    </div>
    <div class="col-lg-6 text-right">
        <span>Search: </span>
        <input type="text" name="table_filter_search" class="table_filter_search" value="{{ $request->table_filter_search ?? '' }}" class="">
    </div>
</div>
<!--RECORD WILL BE APPEND HERE in #append-record FROM RENDERED VIEW VIA AJAX-->
<div id="append-record"></div>
