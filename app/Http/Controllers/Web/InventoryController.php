<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menghitung total harga semua aset
        $totalPrice = Asset::sum('purchase_cost');

        // Menghitung jumlah total aset
        $totalAssets = Asset::count();

        $assets = Asset::all();
        return view('inventory.asset', ['assets' => $assets, 'totalPrice' => $totalPrice, 'totalAssets' => $totalAssets,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shared.component.popup-add-asset');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* START POST REQUEST DATA */
        $validated = request()->validate([
            'asset_name' => 'required|string|max:255',
            'category' => 'required|string',
            'purchase_cost' => 'required|numeric|min:0|max:999999999999',
            'purchase_date' => 'required|date',
            'status' => 'required|string',
            'description' => 'nullable|string|max:1000'
        ]);

        $asset = Asset::create([
            'asset_name' => $validated['asset_name'],
            'category' => $validated['category'],
            'purchase_cost' => $validated['purchase_cost'],
            'purchase_date' => $validated['purchase_date'],
            'status' => $validated['status'],
            'description' => $validated['description'],
        ]);

        $asset->save();
        /* END POST REQUEST DATA */

        return redirect()->route('inventory.index')->with('success', 'Data asset berhasil ditambahkan!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assets = Asset::latest()->get();
        return view('inventory.asset', [
            'assets' => $assets,
        ]);
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
    public function destroy(Request $request)
    {
        $assetIds = $request->input('asset_ids');
        if ($assetIds) {
            Asset::whereIn('asset_id', $assetIds)->delete();
            return redirect()->route('inventory.index')->with('success', 'Asset yang dipilih telah dihapus.');
        }
        return redirect()->route('inventory.index')->with('error', 'Tidak ada asset yang dipilih.');
    }
}
