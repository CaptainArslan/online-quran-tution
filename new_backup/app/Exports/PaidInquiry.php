<?php

namespace App\Exports;

use App\Models\Inquiry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaidInquiry implements FromView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('admin.exports.paid_inquiry', [
            'paidInquirys'=>$this->data,
        ]);
    }
}
