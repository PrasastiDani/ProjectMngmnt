<?php

namespace App\Http\Controllers\Api\Income;

use App\Http\Controllers\Controller;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    // Menampilkan daftar semua pendapatan
    public function index()
    {
        $incomes = Income::with('payment')->get();
        return response()->json($incomes);
    }

    // Menyimpan pendapatan baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'source' => 'required|string|max:255',
            'payment_id' => 'required|exists:payments,payment_id',
            'date' => 'required|date',
            'description' => 'required|string|max:50',
        ]);

        $income = Income::create($request->all());

        return response()->json($income, 201);
    }

    // Menampilkan pendapatan tertentu
    public function show($id)
    {
        $income = Income::with('payment')->findOrFail($id);
        return response()->json($income);
    }

    // Menampilkan formulir untuk mengedit pendapatan
    public function edit($id)
    {
        $income = Income::findOrFail($id);
        return response()->json($income);
    }

    // Memperbarui pendapatan tertentu
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'source' => 'required|string|max:255',
            'payment_id' => 'required|exists:payments,payment_id',
            'date' => 'required|date',
            'description' => 'required|string|max:50',
        ]);

        $income = Income::findOrFail($id);
        $income->update($request->all());

        return response()->json($income);
    }

    // Menghapus pendapatan tertentu
    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();

        return response()->json(['message' => 'Income deleted successfully']);
    }
}
