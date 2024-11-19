<?php

namespace App\Http\Controllers\Api\Expenses;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return response()->json($expenses);
    }
    
    // Menyimpan pengeluaran baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'date' => 'required|date',
            'source' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $expense = Expense::create($request->all());

        return response()->json($expense, 201);
    }

    // Menampilkan pengeluaran tertentu
    public function show($id)
    {
        $expense = Expense::findOrFail($id);
        return response()->json($expense);
    }


    // Memperbarui pengeluaran tertentu
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'date' => 'required|date',
            'source' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update($request->all());

        return response()->json($expense);
    }

    // Menghapus pengeluaran tertentu
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return response()->json(['message' => 'Expense deleted successfully']);
    }
}
