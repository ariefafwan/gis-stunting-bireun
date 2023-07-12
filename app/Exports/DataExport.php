<?php

namespace App\Exports;

use App\Models\Data;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataExport implements FromView
{
    public function view(): View
    {
        return view('admin.data.export', [
            'data' => Data::all()
        ]);
    }
}
