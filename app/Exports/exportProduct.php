<?php

namespace App\Exports;

use App\Models\product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class exportProduct implements FromView
{
    public function view(): View
    {
        return view('admin.excel.exportProduct', [
            'products' => product::where(['invalid' => 0])->get()
        ]);
    }
}
