<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillProducts extends Model
{
    /**
     * Main table primary key
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */

    protected $fillable =  ['productUUID','user','qty','isProcessed'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(){
        return $this->belongsTo('App\Models\Product','productUUID');
    }



}
