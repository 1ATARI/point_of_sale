<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = [];
    public $translatable = ['name', 'description'];

    protected $appends = ['image_path' , 'profit_percent'];


    public function getImagePathAttribute()
    {
        return asset('uploads/products_image/' . $this->image);

    }


    public function getProfitPercent()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100/ $this->purchase_price;
        return number_format($profit_percent , 2 );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        $this->belongsToMany(Order::class , 'product_order');
    }

}
