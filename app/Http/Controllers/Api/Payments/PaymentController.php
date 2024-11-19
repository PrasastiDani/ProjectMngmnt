<?php

namespace App\Http\Controllers\Api\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('reservations')->get();
        return response()->json($payments);
    }

    // Menyimpan pembayaran baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,reservation_id', 
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'payment_date' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|string|max:50',
            'proof_of_payment' => 'nullable|string|max:255',
        ]);

        $payment = Payment::create($request->only([
            'reservation_id',
            'amount',
            'payment_method',
            'payment_date',
            'status',
            'proof_of_payment'
        ]));

        return response()->json($payment, 201);
    }

    // Menampilkan pembayaran tertentu
    public function show($id)
    {
        $payment = Payment::with('reservations')->findOrFail($id);
        return response()->json($payment);
    }

    // Menampilkan formulir untuk mengedit pembayaran
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return response()->json($payment);
    }

    // Memperbarui pembayaran tertentu
    public function update(Request $request, $id)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,reservation_id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'payment_date' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|string|max:50',
            'proof_of_payment' => 'nullable|string|max:255',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        return response()->json($payment);
    }

    // Menghapus pembayaran tertentu
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
