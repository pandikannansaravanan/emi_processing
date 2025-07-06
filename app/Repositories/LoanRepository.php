<?php
namespace App\Repositories;

use App\Models\LoanDetails;

class LoanRepository
{
    public function getAllLoans()
    {
        return LoanDetails::all();
    }

    public function getDateRange()
    {
        return [
            'min' => LoanDetails::min('first_payment_date'),
            'max' => LoanDetails::max('last_payment_date'),
        ];
    }
}
