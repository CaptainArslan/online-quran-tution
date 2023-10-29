<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Expense implements FromView
{
    protected $payouts;

    public function __construct($payouts)
    {
        $this->payouts = $payouts;
    }

    public function view(): View
    {
        return view('admin.exports.finance_expense', [
            'expenses'=>$this->payouts,
        ]);
    }
}
