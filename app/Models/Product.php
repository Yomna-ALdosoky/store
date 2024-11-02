<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable= [
        'name', 'slug', 'description', 'image','categories_id', 
        'store_id', 'price', 'compare_price', 'status',
    ];
    
    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope);
    }

    public function category() 
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function store() 
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags() {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id',
        );
    }

    public function scopeActive(Builder $builder){
        $builder->where('status', '=', 'active');
    }
    //  Accessors

    public function getImageUrlAttribute(){

        if(!$this->image){
            return "https://www.proclinic-products.com/build/static/default-product.30484205.png";
        }

        if(Str::startsWith($this->image, ['http://', 'https://'])){
            return $this->image;
        }
        
        return asset('storge/' . $this->image);
    }

    public function getSalepercentAttribute() 
    {
        if(!$this->compare_price) {
            return "0";
        }
        return round( 100-( 100*$this->price / $this->compare_price), 1);
    }
}
