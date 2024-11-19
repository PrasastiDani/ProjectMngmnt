<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        /* START POST REQUEST DATA */

        $validated = $request->validate([
            'date' => 'required|date',
            'description' => 'required|max:80',
            'category' => 'required',
            'amount' => 'required|numeric',
        ]);

        // dd($validated);

        Expense::create([
            'date' => $validated['date'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'amount' => $validated['amount'],
        ]);

        return redirect()->route('accounting.index')->with('success', 'Data pengeluaran berhasil ditambahkan!!');
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
