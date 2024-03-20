<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','display_name','category',
    ];

    public function role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class,'roles_permissions','permission_id','role_id');
    }
}
