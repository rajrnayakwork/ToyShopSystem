<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','category_id',
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id','category_id');
    }
}
