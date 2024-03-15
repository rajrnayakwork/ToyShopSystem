<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $with = 'subCategory';
    protected $fillable = [
        'name','vendor_id'
    ];

    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class, 'id','vendor_id');
    }

    public function subCategory(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id','id');
    }
}
