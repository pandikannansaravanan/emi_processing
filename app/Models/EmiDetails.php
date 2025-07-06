<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmiDetails extends Model
{
    protected $table = 'emi_details';

    protected $fillable = [
        'clientid'
    ];

    public function loan()
    {
        return $this->belongsTo('loan_details', 'id', 'loan_id');
    }
}
