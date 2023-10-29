<div class="row">
    <div class="col-lg-6 text-left">
        <p>Showing {{ $searchResults->firstItem() }} to {{ $searchResults->lastItem() }} of {{ $searchResults->total() }} entries</p>
    </div>
    <div class="col-lg-6 text-right">
        {{ $searchResults->onEachSide(1)->links('vendor.pagination.dashboard-pagination') }}
    </div>
</div>
