<?php namespace App\Models;

class Setting extends BaseModel {

    /**
     * Main table primary key
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @var array
     */

    protected $fillable = ['name', 'email', 'phone', 'address1', 'address2', 'city', 'state', 'postal_code',
        'country', 'contact', 'vat', 'website', 'logo', 'favicon','date_format','thousand_separator','decimal_separator','decimals'];

}
