<?php

namespace App\Imports;

use App\Models\product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToArray;

class importNewProduct implements ToArray, WithStartRow
{
    public function array( array $array ) {
		for($i=0;$i<count($array);$i++)
        {
            $data = [
                'product_name' => $array[$i][0],
                'product_qrcode' => $array[$i][1],
                'product_price' => $array[$i][2],
                'product_sell' => $array[$i][3],
                'product_sale' => $array[$i][4],
                'product_quantity' => $array[$i][5],
                'product_description' => $array[$i][6],
                'product_unit' => $array[$i][7],
                'category_id' => $array[$i][8],
                'category_detail_id' => $array[$i][9],
                'author' => $array[$i][10],
                'publisher_id' => $array[$i][11],
                'publishing_year' => $array[$i][12],
                'thumbnail' => $array[$i][13],
                'thumbnail1' => $array[$i][14],
                'thumbnail2' => $array[$i][15],
                'thumbnail3' => $array[$i][16],
                'thumbnail4' => $array[$i][17],
                'thumbnail5' => $array[$i][18],
                'slug' => $array[$i][19],
                'product_language' => $array[$i][20],
                'product_pages' => $array[$i][21],
                'product_dimensions' => $array[$i][22],
                'product_weight' => $array[$i][23],
                'status' => $array[$i][24],
            ];
            product::create($data);
        }
        return "success";
	}

	public function startRow(): int {
    	return 2;
	}
}
