<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
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
            'source' => 'required',
            'amount' => 'required|numeric',
        ]);

        // dd($validated);

        Income::create([
            'date' => $validated['date'],
            'description' => $validated['description'],
            'source' => $validated['source'],
            'amount' => $validated['amount'],
        ]);

        return redirect()->route('accounting.index')->with('success', 'Data pemasukan berhasil ditambahkan!!');
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
