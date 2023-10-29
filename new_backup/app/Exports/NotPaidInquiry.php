<?php

namespace App\Exports;

use App\Models\Inquiry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NotPaidInquiry implements FromView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('admin.exports.not_paid_inquiry', [
            'notPaidInquirys'=>$this->data,
        ]);
    }
}
