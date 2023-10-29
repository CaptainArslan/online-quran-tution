<?php

namespace App\Exports;

use App\Models\Inquiry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CancelSubInquiry implements FromView
{
    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function view(): View
    {
        return view('admin.exports.cancel_sub_inquiry', [
            'cancel_subs'=>$this->students,
        ]);
    }
}
