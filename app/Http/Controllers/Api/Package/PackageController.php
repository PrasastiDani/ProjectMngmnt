<?php

namespace App\Http\Controllers\Api\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    // Menampilkan daftar semua paket
    public function index()
    {
        $packages = Package::all();
        return response()->json($packages);
    }

    // Menyimpan paket baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'pakage_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'imageUrls' => 'nullable|array',
            'imageUrls.*' => 'url',
        ]);

        $packageData = $request->all();

        // Mengonversi imageUrls menjadi JSON jika ada
        if (isset($packageData['imageUrls'])) {
            $packageData['imageUrls'] = json_encode($packageData['imageUrls']);
        }

        // Menggunakan $packageData untuk menyimpan ke database
        $package = Package::create($packageData);

        return response()->json($package, 201);
    }

    // Menampilkan paket tertentu
    public function show($id)
    {
        try {
            $package = Package::findOrFail($id);

            // Meng-decode imageUrls jika ada
            if ($package->imageUrls) {
                $package->imageUrls = json_decode($package->imageUrls);
            }

            return response()->json($package);
        } catch (\Exception $e) {
            // Log error dan kembalikan response error
            Log::error('Error fetching package: ' . $e->getMessage());
            return response()->json(['error' => 'Package not found'], 404);
        }
    }

    // Memperbarui paket tertentu
    public function update(Request $request, $id)
    {
        $request->validate([
            'pakage_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'imageUrls' => 'nullable|array',
            'imageUrls.*' => 'url',
        ]);

        $packageData = $request->all();

        // Mengonversi imageUrls menjadi JSON jika ada
        if (isset($packageData['imageUrls'])) {
            $packageData['imageUrls'] = json_encode($packageData['imageUrls']);
        }

        $package = Package::findOrFail($id);
        // Menggunakan $packageData untuk memperbarui data
        $package->update($packageData);

        return response()->json($package);
    }

    public function destroy($id){
    
        try {
            // Mencari paket berdasarkan pakage_id
            $package = Package::where('pakage_id', $id)->firstOrFail();
            $package->delete();

            return response()->json(['message' => 'Package deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting package: ' . $e->getMessage());
            return response()->json(['error' => 'Package not found'], 404);
        }
    }
}
