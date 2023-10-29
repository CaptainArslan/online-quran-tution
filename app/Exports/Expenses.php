<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Expenses implements FromView
{
    protected $expense;

    public function __construct($expense)
    {
        $this->expense = $expense;
    }

    public function view(): View
    {
        return view('admin.exports.expenses', [
            'expenses'=>$this->expense,
        ]);
    }
}
