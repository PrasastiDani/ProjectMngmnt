<?php

namespace App\Http\Controllers\Api\Assets;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
 // Menampilkan daftar semua aset
 public function index()
 {
     $assets = Asset::all();
     return response()->json($assets);
 }


 // Menyimpan aset baru ke dalam database
 public function store(Request $request)
 {
     $request->validate([
         'asset_name' => 'required|string|max:255',
         'category' => 'required|string|max:255',
         'purchase_cost' => 'required|numeric|min:0',
         'purchase_date' => 'required|date',
         'status' => 'required|string|max:50',
         'description' => 'nullable|string|max:255',
     ]);

     $asset = Asset::create($request->all());

     return response()->json($asset, 201);
 }

 // Menampilkan aset tertentu
 public function show($id)
 {
     $asset = Asset::findOrFail($id);
     return response()->json($asset);
 }


 // Memperbarui aset tertentu
 public function update(Request $request, $id)
 {
     $request->validate([
         'asset_name' => 'required|string|max:255',
         'category' => 'required|string|max:255',
         'purchase_cost' => 'required|numeric|min:0',
         'purchase_date' => 'required|date',
         'status' => 'required|string|max:50',
         'description' => 'nullable|string|max:255',
     ]);

     $asset = Asset::findOrFail($id);
     $asset->update($request->all());

     return response()->json($asset);
 }

 // Menghapus aset tertentu
 public function destroy($id)
 {
     $asset = Asset::findOrFail($id);
     $asset->delete();

     return response()->json(['message' => 'Asset deleted successfully']);
 }
}
