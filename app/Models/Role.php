<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'id';

    public function permission(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class,'roles_permissions','role_id','permission_id');
    }

}
