<div class="p-6 rounded-lg shadow-md h-50" style="background: #E8F6EC;">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Total Saldo</h2>
    </div>
    <div class="text-3xl font-bold {{ $balance < 0 ? 'text-red-600' : 'text-black' }}">
        IDR {{ number_format($balance, 0, ',', '.') }}
    </div>

    <div class="flex justify-between mt-4">
        <div class="text-left">
            <p class="text-sm text-gray-600">Pengeluaran</p>
            <p class="text-red-600 font-bold">-{{ number_format($totalExpense, 0, ',', '.') }}</p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-600">Pemasukan</p>
            <p class="text-green-600 font-bold">{{ number_format($totalIncome, 0, ',', '.') }}</p>
        </div>
    </div>
</div>
