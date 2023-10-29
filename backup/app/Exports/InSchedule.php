<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InSchedule implements FromView
{
    protected $schedules;

    public function __construct($schedules)
    {
        $this->schedules = $schedules;
    }

    public function view(): View
    {
        return view('admin.exports.inquiry_schedule', [
            'schedules'=>$this->schedules,
        ]);
    }
}
