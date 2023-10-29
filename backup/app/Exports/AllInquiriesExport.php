<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllInquiriesExport implements FromView
{
    protected $pay_outs;

    public function __construct($pay_outs)
    {
        $this->pay_outs = $pay_outs;
    }

    public function view(): View
    {
        return view('admin.exports.all_inquiries', [
            'all_inquiries'=>$this->pay_outs,
        ]);
    }
}
