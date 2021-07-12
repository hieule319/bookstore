<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_detail extends Model
{
    protected $table = 'category_detail';
    protected $fillable = [
        'category_detail_name',
        'category_id',
        'slug',
        'invalid'
    ];

    public function category()
    {
        return $this->hasMany(category::class, 'id', 'category_id');
    }

    public static function getListProductBySlug($slug)
    {
        return self::select(
            'category_detail.id',
            'product.id',
            'product.product_name',
            'product.product_sell',
            'product.product_sale',
            'product.category_id',
            'product.thumbnail',
            'product.slug'
        )
            ->join('product', 'product.category_detail_id', '=', 'category_detail.id')
            ->where(['category_detail.slug' => $slug, 'category_detail.invalid' => 0, 'product.invalid' => 0, 'product.status' => 0])
            ->orderBy('product.product_name', 'asc')->paginate(10);
    }

    public static function getListCategoryDetail()
    {
        return self::select('category_detail.*', 'category.category_name')->join('category', 'category.id', '=', 'category_detail.category_id')->where(['category_detail.invalid' => 0])
            ->orderBy('category_detail.id', 'desc')->get();
    }

    public static function insertOrUpdateCategoryDetail($data, $id = null)
    {
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

    public static function checkExistsCategoryDetail($name)
    {
        return self::where(['category_detail_name' => $name, 'invalid' => 0])->count();
    }

    public static function deleteCategoryDetail($id)
    {
        $result = self::where(['id' => $id, 'invalid' => 0])->update(['invalid' => 1]);
        if ($result) {
            return 'success';
        }
    }
}
