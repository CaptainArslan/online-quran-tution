<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PendingPayments implements FromView
{
    protected $pay_outs;

    public function __construct($pay_outs)
    {
        $this->pay_outs = $pay_outs;
    }

    public function view(): View
    {
        return view('admin.exports.payments', [
            'payments'=>$this->pay_outs,
        ]);
    }
}
