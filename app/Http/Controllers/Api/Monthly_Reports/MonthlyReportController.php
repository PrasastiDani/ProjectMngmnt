<?php

namespace App\Http\Controllers\Api\Monthly_Reports;

use App\Http\Controllers\Controller;
use App\Models\Monthly_Report;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller
{
    // Menampilkan daftar semua laporan bulanan
    public function index()
    {
        $reports = Monthly_Report::all();
        return response()->json($reports);
    }


    // Menyimpan laporan bulanan baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000',
            'total_income' => 'required|numeric|min:0',
            'net_profit' => 'required|numeric|min:0',
        ]);

        $report = Monthly_Report::create($request->all());

        return response()->json($report, 201);
    }

    // Menampilkan laporan bulanan tertentu
    public function show($id)
    {
        $report = Monthly_Report::findOrFail($id);
        return response()->json($report);
    }

    // Memperbarui laporan bulanan tertentu
    public function update(Request $request, $id)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000',
            'total_income' => 'required|numeric|min:0',
            'net_profit' => 'required|numeric|min:0',
        ]);

        $report = Monthly_Report::findOrFail($id);
        $report->update($request->all());

        return response()->json($report);
    }

    // Menghapus laporan bulanan tertentu
    public function destroy($id)
    {
        $report = Monthly_Report::findOrFail($id);
        $report->delete();

        return response()->json(['message' => 'Monthly report deleted successfully']);
    }
}
