<?php

namespace App\Http\Controllers\Api\History;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{
   // Menampilkan daftar semua riwayat
   public function index()
   {
       $histories = History::with(['user', 'reservations'])->get();
       return response()->json($histories);
   }

   public function getHistoriesByUserId(Request $request)
   {
       // Mengambil user_id dari query parameter
       $userId = $request->query('user_id');
   
       // Menyimpan log permintaan dengan user_id
       Log::info('Permintaan riwayat dengan user_id: ' . $userId);
   
       // Validasi user_id
       $request->validate([
           'user_id' => 'required|exists:users,id',
       ]);
   
       // Mengambil data history berdasarkan user_id
       $histories = History::with(['user', 'reservations'])
           ->where('user_id', $userId)
           ->get();
   
       // Menyimpan log jumlah history yang ditemukan
       Log::info('Jumlah riwayat ditemukan: ' . $histories->count());
   
       // Jika tidak ada history yang ditemukan
       if ($histories->isEmpty()) {
           Log::info('Tidak ada riwayat ditemukan untuk user_id: ' . $userId);
           return response()->json(['message' => 'Tidak ada riwayat ditemukan untuk user_id ini.'], 200);
       }
   
       // Mengembalikan data riwayat yang ditemukan
       return response()->json([
           'status' => 'success',
           'data' => $histories,
       ]);
   }
   
   // Menyimpan riwayat baru ke dalam database
   public function store(Request $request)
   {
       $request->validate([
           'user_id' => 'required|exists:users,id',
           'reservation_id' => 'required|exists:reservations,reservation_id',
           'photo_link' => 'nullable|url',
         
       ]);

       $history = History::create($request->all());

       return response()->json($history, 201);
   }

   // Menampilkan riwayat tertentu
   public function show($id)
   {
       $history = History::with(['user', 'reservations'])->findOrFail($id);
       return response()->json($history);
   }

   // Menampilkan formulir untuk mengedit riwayat
   public function edit($id)
   {
       $history = History::findOrFail($id);
       return response()->json($history);
   }

   // Memperbarui riwayat tertentu
   public function update(Request $request, $id)
   {
       $request->validate([
           'user_id' => 'required|exists:users,id',
           'reservation_id' => 'required|exists:reservations,reservation_id',
           'photo_link' => 'nullable|url',
    
       ]);

       $history = History::findOrFail($id);
       $history->update($request->all());

       return response()->json($history);
   }

   // Menghapus riwayat tertentu
   public function destroy($id)
   {
       $history = History::findOrFail($id);
       $history->delete();

       return response()->json(['message' => 'History deleted successfully']);
   }
}
