<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Reservation;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // filter reservasi yang akan ditampilkan
        $filter = $request->input('filter', 'all');
        $query = Reservation::with(['user', 'package', 'payment']);

        // Total, completed, and pending reservation counts
        $totalReservations = Reservation::count();

        $completedReservations = Reservation::whereHas('history')
            ->count();

        $pendingReservations = Reservation::doesntHave('history')
            ->count();

        if ($filter === 'new') {
            // Filter untuk reservasi yang belum ada di tabel history
            $query->doesntHave('history');
        } elseif ($filter === 'passed') {
            // Filter untuk reservasi yang sudah ada di tabel history
            $query->has('history');
        }

        // filter hanya reservasi hari ini
        $todayReservations = Reservation::with('user')
        ->whereDate('event_date', now()->toDateString())
        ->get();

        $reservation = $query->orderBy('created_at', 'desc')->get();
        return view('transaction.incoming-order', [
            'reserve' => $reservation,
            'filter' => $filter,
            'totalReservations' => $totalReservations,
            'completedReservations' => $completedReservations,
            'pendingReservations' => $pendingReservations,
            'todayReservations' => $todayReservations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $reservationId)
    {
        $validated = $request->validate([
            'photo_link' => 'required|active_url',
        ]);

        $reservation = Reservation::findOrFail($reservationId);
        $userId = $reservation->user_id;

        History::create([
            'user_id' => $userId,
            'reservation_id' => $reservationId,
            'photo_link' => $validated['photo_link'],
        ]);

        return redirect()->route('transaction.index')->with('success', 'Url berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
