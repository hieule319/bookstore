<?php

namespace App\Models;

use App\Helper\Util;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'product_name',
        'product_qrcode',
        'product_price',
        'product_sell',
        'product_sale',
        'product_quantity',
        'product_description',
        'product_unit',
        'category_id',
        'category_detail_id',
        'author',
        'publisher_id',
        'publishing_year',
        'thumbnail',
        'thumbnail1',
        'thumbnail2',
        'thumbnail3',
        'thumbnail4',
        'thumbnail5',
        'slug',
        'product_language',
        'product_pages',
        'product_dimensions',
        'product_weight',
        'status',
        'invalid'
    ];

    public function category()
    {
        return $this->hasOne(category::class, 'id', 'category_id');
    }

    public function category_detail()
    {
        return $this->hasOne(category_detail::class, 'id', 'category_detail_id');
    }

    public function publisher()
    {
        return $this->hasOne(publisher::class, 'id', 'publisher_id');
    }

    public static function getProductBySlug($slug)
    {
        return self::select('product.*','publisher.publisher_name')
        ->join('publisher','publisher.id','=','product.publisher_id')
        ->where(['product.invalid' => 0,'product.status' => 0,'product.slug' => $slug])->get();
    }

    public static function getListProduct()
    {
        return self::where(['invalid' => 0])->orderBy('id','desc')->get();
    }

    public static function insertOrUpdateProduct($data,$id = null)
    {
        if(is_null($id))
        {
            if(isset($data['list_thumbnail']))
            {
                $list_thumbnail = json_decode($data['list_thumbnail']);
                if($list_thumbnail != null)
                {
                    $j = 1;
                    for($i=0;$i<count($list_thumbnail);$i++)
                    {
                        $data['thumbnail'.$j] = $list_thumbnail[$i];
                        $j++;
                    }
                }else{
                    $data['thumbnail1'] = $data['list_thumbnail'];
                }
            }
            self::create($data);
        }else{
            self::where(['id' => $id,'invalid' => 0])->update($data);
        }

        return 'success';
    }

    public static function getProductById($id)
    {
        return self::with('category','category_detail','publisher')->where(['product.id' => $id,'product.invalid' => 0])->get();
    }

    public static function deleteProduct($id)
    {
        $result = self::where(['id' => $id,'invalid' => 0])->update(['invalid' => 1]);
        if($result)
        {
            return 'success';
        }
    }

    public static function getAllProduct()
    {
        return self::where(['invalid' => 0])->orderBy('product_name','asc')->paginate(10);
    }

    public static function getListLatestProduct()
    {
        return self::where(['invalid' => 0])->orderBy('id','desc')->limit(8)->get();
    }

    public static function getProductSlug($slug)
    {
        return self::where(['slug' => $slug,'invalid' => 0])->first();
    }

    public static function getListSimilarProduct($subCategoryId)
    {
        return self::where(['category_detail_id' => $subCategoryId,'invalid' => 0])->orderBy('id','desc')->limit(8)->get();
    }

    public static function getNewProduct()
    {
        return self::where(['invalid' => 0])->orderBy('id','desc')->limit(4)->get();
    }

    public static function getListProductSale()
    {
        return self::where(['invalid' => 0])->where('product_sale','!=',null)->orderBy('id','desc')->limit(8)->get();
    }

    public static function searchProduct($data)
    {
        return self::where(['status' => 0,'invalid' => 0])->where('product_name','LIKE','%'.$data['query'].'%')->orderBy('product_name','asc')->paginate(10);
    }

    public static function createProductCode()
    {
        $products =  self::where(['invalid' => 0,'product_qrcode' => null])->get();
        if(is_null($products))
        {
            return 'fail';
        }
        for($i=0;$i<count($products);$i++)
        {
            $product_code = Util::generateProductQrCode();
            $data['product_qrcode'] = $product_code;
            $query = self::where(['id' => $products[$i]['id']])->update($data);
        }
        return 'success';
    }
}
