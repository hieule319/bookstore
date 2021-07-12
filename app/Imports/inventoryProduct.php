<?php

namespace App\Imports;

use App\Models\inventory;
use App\Models\product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToArray;

class inventoryProduct implements ToArray, WithStartRow
{
    public function array( array $array ) {
		for($i=0;$i<count($array);$i++)
        {
            $data = [
                'product_name' => $array[$i][0],
                'product_qrcode' => $array[$i][1],
                'product_price' => $array[$i][2],
                'product_quantity' => $array[$i][3],
                'total_price' => $array[$i][4],
            ];
            $product = product::where(['invalid' => 0,'product_qrcode' => $array[$i][1]])->first();
            $pro['product_quantity'] = $product['product_quantity'] + $array[$i][3];
            inventory::create($data);
            $product->update($pro);
        }
        return "success";
	}

	public function startRow(): int {
    	return 2;
	}
}
