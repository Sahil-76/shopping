<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\brand;
use App\Models\subcategory;


class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; 
    protected $fillable = ['name'];
    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }
}
