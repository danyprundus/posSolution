<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends BaseModel
{
    protected $fillable = ['name', 'description'];

    /**
     * Main table primary key
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
