<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDetails extends Model
{
    protected $table = 'loan_details';

    protected $fillable = [
        'loan_id',
        'clientid',
        'num_of_payment',
        'loan_amount',
        'first_payment_date',
        'last_payment_date',
    ];
}
