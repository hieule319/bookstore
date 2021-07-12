<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'category_name',
        'status',
        'slug',
        'invalid'
    ];

    public function category_detail()
    {
        return $this->hasMany(category_detail::class, 'category_id', 'id')->where('category_detail.invalid', 0);
    }

    public function product()
    {
        return $this->hasMany(product::class, 'category_id', 'id')->where(['product.invalid' => 0, 'product.status' => 0]);
    }

    public static function getListCategory()
    {
        return self::where(['invalid' => 0])->orderBy('id', 'desc')->get();
    }

    public static function v2_getListCategory()
    {
        return self::select('id', 'category_name', 'slug')->with('category_detail')
            ->where(['invalid' => 0, 'status' => 0])->get();
    }

    public static  function getListProductBySlug($slug)
    {
        return self::select(
            'category.id',
            'product.id',
            'product.product_name',
            'product.product_sell',
            'product.product_sale',
            'product.category_id',
            'product.thumbnail',
            'product.slug'
        )
            ->join('product', 'product.category_id', '=', 'category.id')
            ->where(['category.slug' => $slug, 'category.invalid' => 0, 'category.status' => 0, 'product.invalid' => 0, 'product.status' => 0])
            ->orderBy('product.product_name', 'asc')->paginate(10);

    }

    public static function insertOrUpdateCategory($data, $id = null)
    {
        if (isset($data['category_name'])) {
            $check = self::checkNameCategory($data['category_name']);
            if (!is_null($check)) {
                return 'existscategory';
            }
        }

        if (is_null($id)) {
            $result = self::create($data);
        } else {
            $result = self::where([
                'id' => $id,
                'invalid' => 0
            ])->update($data);
        }

        return 'success';
    }

    public static function checkNameCategory($name)
    {
        return self::where([
            'category_name' => $name,
            'invalid' => 0
        ])->first();
    }

    public static function deleteCategory($id)
    {
        $result = self::where(['id' => $id, 'invalid' => 0])->update(['invalid' => 1]);
        if ($result) {
            return 'success';
        }
    }

    public static function getPrudctByCategory()
    {
        return self::select('category.id')->with('product')->where(['category.invalid' => 0,'category.status' => 0])->get();
    }
}
