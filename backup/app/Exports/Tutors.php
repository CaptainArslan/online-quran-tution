<?php

namespace App\Exports;

use App\Models\Tutor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Tutors implements FromView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('admin.exports.tutors', [
            'tutors'=>$this->data,
        ]);
    }
}
