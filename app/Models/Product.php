<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $with = 'subCategory';
    protected $fillable = [
        'name','price','description','availability','sub_category_id',
    ];

    public function subCategory(): HasOne
    {
        return $this->hasOne(SubCategory::class,'id','sub_category_id');
    }
}
