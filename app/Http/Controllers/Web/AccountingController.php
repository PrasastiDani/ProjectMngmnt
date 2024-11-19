<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        // Query income dan expense dengan filter bulan dan tahun jika diberikan
        $incomeQuery = Income::query();
        $expenseQuery = Expense::query();

        if ($month) {
            $incomeQuery->whereMonth('date', $month);
            $expenseQuery->whereMonth('date', $month);
        }

        if ($year) {
            $incomeQuery->whereYear('date', $year);
            $expenseQuery->whereYear('date', $year);
        }

        // Ambil data yang sudah difilter
        $income = $incomeQuery->get();
        $expense = $expenseQuery->get();

        // Menghitung total pemasukan
        $incomeTotal = Income::sum('amount');
        // Menghitung total pengeluaran
        $expenseTotal = Expense::sum('amount');
        // Menghitung balance
        $balance = $incomeTotal - $expenseTotal;

        // Hitung total keseluruhan untuk mendapatkan persentase
        $amountTotal = $incomeTotal + $expenseTotal;

        // Cegah pembagian dengan nol jika totalAmount bernilai 0
        $incomePercentage = $amountTotal ? ($incomeTotal / $amountTotal) * 100 : 0;
        $expensePercentage = $amountTotal ? ($expenseTotal / $amountTotal) * 100 : 0;
        $balancePercentage = $amountTotal ? ($balance / $amountTotal) * 100 : 0;

        $income = Income::all();
        $expense = Expense::all();
        // dd($income);
        return view('accounting.recap', [
            'totalIncome' => $incomeTotal,
            'totalExpense' => $expenseTotal,
            'balance' => $balance,
            'income' => $income,
            'expense' => $expense,
            'percentageIncome' => $incomePercentage,
            'percentageExpense' => $expensePercentage,
            'percentageBalance' => $balancePercentage,
            'selectedMonth' => $month,
            'selectedYear' => $year,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function income_store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
