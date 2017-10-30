<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends BaseModel
{
    protected $fillable = ['name', 'description'];
    /**
     * Main table primary key
     * @var string
     */
    protected $primaryKey = 'uuid';

    public function permissions(){
        return $this->belongsToMany(Permission::class)->select(array('name'));
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'uuid');
    }

    public function assign($permissions){
        return $this->permissions()->sync($permissions);
    }
}
