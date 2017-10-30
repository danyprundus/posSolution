<?php namespace App\Models;


class Invoice extends BaseModel {

    /**
     * Main table primary key
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @var array
     */

    protected $fillable = ['client_id', 'number', 'invoice_date', 'due_date', 'status', 'discount', 'terms', 'notes', 'currency'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function items(){
        return $this->hasMany('App\Models\InvoiceItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function payments(){
        return $this->hasMany('App\Models\Payment');
    }

}
