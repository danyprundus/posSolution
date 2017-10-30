<?php namespace App\Models;

class TaxSetting extends BaseModel {

    /**
     * Main table primary key
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @var array
     */

    protected $fillable = ['name', 'value', 'selected'];

    public function estimateItems(){
        return $this->hasMany('App\Models\EstimateItem');
    }

}
