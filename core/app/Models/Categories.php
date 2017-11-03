<?php

namespace App\Models;
class Categories extends BaseModel
{

    /**
     * Main table primary key
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */

    protected $fillable =  ['parent_id', 'name', 'slug'];
}
