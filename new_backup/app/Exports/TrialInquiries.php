<?php

namespace App\Exports;

use App\Models\Inquiry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TrialInquiries implements FromView
{
    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function view(): View
    {
        return view('admin.exports.trail_inquiry', [
            'trial'=>$this->students,
        ]);
    }
}
