<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class EmiService
{
    public function processEmi()
    {
        $loans = DB::table('loan_details')->get();

        $minDate = DB::table('loan_details')->min('first_payment_date');
        $maxDate = DB::table('loan_details')->max('last_payment_date');
        $months = $this->getMonthRange($minDate, $maxDate);
        // dd($loans, $minDate, $maxDate,$months);

        // Drop & recreate table
        DB::statement('DROP TABLE IF EXISTS emi_details');

        $columns = "`clientid` INT";
        foreach ($months as $month) {
            $columns .= ", `$month` DECIMAL(10,2) DEFAULT 0";
        }

        $createSql = "CREATE TABLE emi_details ($columns)";
        DB::statement($createSql);

        foreach ($loans as $loan) {
            $emiAmount = round($loan->loan_amount / $loan->num_of_payment, 2);

            $first = new \DateTime($loan->first_payment_date);
            $current = new \DateTime($first->format('Y-m-01'));
            $last = new \DateTime($loan->last_payment_date);
            $interval = new \DateInterval('P1M');
            $period = new \DatePeriod($current, $interval, $last);
            $emiData = [];
            foreach ($months as $m) {
                $emiData[$m] = 0.00;
            }

            $paid = 0;
            $i = 0;
            foreach ($period as $dt) {
                $key = $dt->format('Y_M');
                $i++;
                if ($i == $loan->num_of_payment) {
                    // Last payment (Adjusted)
                    $emiData[$key] = $loan->loan_amount - $paid;
                } else {
                    $emiData[$key] = $emiAmount;
                    $paid += $emiAmount;
                }
            }
            $emiData['clientid'] = $loan->clientid;

            DB::table('emi_details')->insert($emiData);
        }
    }

    private function getMonthRange($start, $end)
    {
        $start    = new \DateTime($start);
        $end      = new \DateTime($end);
        // $end->modify('+1 month');
        $interval = new \DateInterval('P1M');

        // Snap to first day of starting month
        $current = new \DateTime($start->format('Y-m-01'));
        $period   = new \DatePeriod($current, $interval, $end);

        $months = [];
        foreach ($period as $dt) {
            $months[] = $dt->format('Y_M');
        }

        return $months;
    }

    public function getEmiDetails()
    {
        return DB::table('emi_details')->get();
    }
}
