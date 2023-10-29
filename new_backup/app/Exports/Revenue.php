<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Revenue implements FromView
{
    protected $subscriptions;

    public function __construct($subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    public function view(): View
    {
        return view('admin.exports.finance_evenue', [
            'revenues'=>$this->subscriptions,
        ]);
    }
}
