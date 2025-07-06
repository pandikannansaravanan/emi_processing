<?php
namespace App\Http\Controllers;

use App\Repositories\LoanRepository;
use App\Services\EmiService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    protected $loanRepo;
    protected $emiService;

    public function __construct(LoanRepository $loanRepo, EmiService $emiService)
    {
        $this->loanRepo = $loanRepo;
        $this->emiService = $emiService;
    }

    public function index()
    {
        $loans = $this->loanRepo->getAllLoans();
        return view('loans.index', compact('loans'));
    }

    public function emi()
    {
        $emiDetails = [];
        return view('loans.emi', compact('emiDetails'));
    }

    public function processEmi()
    {
        $this->emiService->processEmi();
        $emiDetails = $this->emiService->getEmiDetails();
        // return view('loans.emi', compact('emiDetails'));
        return response()->json([
            'status' => 'success',
            'message' => 'EMI details processed successfully.',
            'emiDetails' => $emiDetails
        ]);
    }
}

