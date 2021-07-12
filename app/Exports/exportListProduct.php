<?php

namespace App\Exports;

use App\Models\product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class exportListProduct implements FromView
{
    public function view(): View
    {
        return view('admin.excel.exportListProduct', [
            'products' => product::where(['invalid' => 0])->get()
        ]);
    }
}
