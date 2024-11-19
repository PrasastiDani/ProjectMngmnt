<?php

namespace App\Http\Controllers\Api\Reservations;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class ReservationController extends Controller
{
    // Menampilkan daftar semua reservasi
    public function index()
    {
        $reservations = Reservation::with(['user', 'package'])->get();
        return response()->json(['status' => 'success', 'data' => $reservations]);
    }
    public function latestByUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $userId = $request->query('user_id');

        $reservations = Reservation::with(['user', 'package'])
            ->where('user_id', $userId)
            ->latest()
            ->take(1)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $reservations
        ]);
    }
    public function upcoming(Request $request)
    {
        // get date for today
        $today = Carbon::today();

        $userId = $request->query('user_id');

        Log::info('Permintaan untuk tanggal: ' . $today->toDateString() . ' dengan user_id: ' . $userId);

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $reservations = Reservation::with(['user', 'package'])
            ->where('user_id', $userId)
            ->whereDate('event_date', '>=', $today)
            ->get();

        Log::info('Jumlah reservasi ditemukan: ' . $reservations->count());

        if ($reservations->isEmpty()) {
            Log::info('Tidak ada reservasi ditemukan untuk tanggal mulai hari ini dengan user_id: ' . $userId);
            return response()->json(['message' => 'Tidak ada reservasi ditemukan untuk tanggal ini atau setelahnya.'], 200);
        }

        return response()->json([
            'status' => 'success',
            'data' => $reservations,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'package_id' => 'required|exists:packages,pakage_id',
                'event_date' => 'required|date',
                'location' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'number_of_people' => 'required|integer|min:1',
                'note' => 'nullable|string',
                'start_time' => 'nullable|date_format:H:i',
                'end_time' => 'nullable|date_format:H:i',

            ]);

            $reservation = Reservation::create($request->all());

            return response()->json([
                'status' => 'success',
                'data' => $reservation,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $e->validator->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the reservation.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Menampilkan reservasi tertentu
    public function show($id)
    {
        $reservation = Reservation::with(['user', 'package'])->findOrFail($id);
        return response()->json($reservation);
    }

    public function getByDate(Request $request)
    {
        // Mendapatkan tanggal dari query parameter
        $eventDate = $request->query('event_date');

        // Log permintaan untuk memudahkan debugging
        Log::info('Permintaan untuk tanggal: ' . $eventDate);

        // Validasi bahwa parameter event_date ada dan formatnya benar
        $request->validate([
            'event_date' => 'required|date_format:Y-m-d', // Validasi format tanggal
        ]);

        // Jika tidak ada tanggal yang diberikan
        if (!$eventDate) {
            return response()->json(['message' => 'Tanggal tidak ditemukan dalam permintaan.'], 400);
        }

        // Ambil reservasi berdasarkan tanggal event
        $reservations = Reservation::with(['user', 'package'])
            ->whereDate('event_date', $eventDate)  // Pastikan event_date adalah tanggal yang dicari
            ->get();  // Ambil semua data yang cocok

        // Log jumlah reservasi yang ditemukan
        Log::info('Jumlah reservasi ditemukan: ' . $reservations->count());

        // Jika tidak ada reservasi ditemukan
        if ($reservations->isEmpty()) {
            Log::info('Tidak ada reservasi ditemukan untuk tanggal: ' . $eventDate);
            return response()->json(['message' => 'Tidak ada reservasi ditemukan untuk tanggal ini.'], 200);
        }

        // Jika ada data, kembalikan dalam bentuk JSON
        return response()->json([
            'status' => 'success',
            'data' => $reservations,  // Menyertakan data reservasi
        ]);
    }


    // Memperbarui reservasi tertentu
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,pakage_id',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'number_of_people' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());

        return response()->json($reservation);
    }

    // Menghapus reservasi tertentu
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted successfully']);
    }
}
