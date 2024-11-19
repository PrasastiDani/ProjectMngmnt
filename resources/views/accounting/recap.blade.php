@extends('shared.layout.dashboard')

@section('content')
    <div class="p-4 sm:ml-64 flex-1 overflow-auto">
        {{-- heading --}}
        @include('shared.component.header')
        {{-- end heading --}}

        <!-- First row with Total Saldo and Rekap Bulanan -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            {{-- Total Saldo --}}
            @include('shared.component.card-total-saldo')

            {{-- Rekap Bulanan --}}
            @include('shared.component.card-rekap-bulanan')
        </div>

        <!-- Second row with List Keuangan -->
        <div class="col-span-full bg-white rounded-lg shadow-md" style="background: #EAEAEA;">
            <div class="p-6">
                <div>
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold">LIST KEUANGAN</h2>
                        {{-- <form method="GET" action="{{ route('accounting.index') }}" class="flex gap-4">
                            <div class="relative">
                                <select name="month"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="" selected>Bulan</option>
                                    <option value="1" {{ request('month') == 1 ? 'selected' : '' }}>January</option>
                                    <option value="2" {{ request('month') == 2 ? 'selected' : '' }}>February</option>
                                    <option value="3" {{ request('month') == 3 ? 'selected' : '' }}>March</option>
                                    <option value="4" {{ request('month') == 4 ? 'selected' : '' }}>April</option>
                                    <option value="5" {{ request('month') == 5 ? 'selected' : '' }}>May</option>
                                    <option value="6" {{ request('month') == 6 ? 'selected' : '' }}>June</option>
                                    <option value="7" {{ request('month') == 7 ? 'selected' : '' }}>July</option>
                                    <option value="8" {{ request('month') == 8 ? 'selected' : '' }}>August</option>
                                    <option value="9" {{ request('month') == 9 ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ request('month') == 10 ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ request('month') == 11 ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ request('month') == 12 ? 'selected' : '' }}>December</option>
                                </select>
                            </div>
                            <div class="relative">
                                <select name="year"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="" selected>Tahun</option>
                                    <option value="2025" {{ request('year') == 2025 ? 'selected' : '' }}>2025</option>
                                    <option value="2024" {{ request('year') == 2024 ? 'selected' : '' }}>2024</option>
                                    <option value="2023" {{ request('year') == 2023 ? 'selected' : '' }}>2023</option>
                                    <!-- Tambahkan tahun lain jika diperlukan -->
                                </select>
                            </div>
                            <button type="submit"
                                class="flex items-center text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 mr-4">Filter</button>
                        </form> --}}
                    </div>
                    <div class="bg-black w-full mt-4 mb-6" style="height: 1px"></div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Income Section -->
                    <div class="bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-4 ml-4 mt-4">
                            <h3 class="text-lg font-semibold pb-2">INCOME</h3>
                            <button data-modal-target="crud-income" data-modal-toggle="crud-income" type="button"
                                class="flex items-center text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 mr-4">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Add
                            </button>
                            @include('shared.component.popup-income')
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Tanggal</th>
                                        <th scope="col" class="px-4 py-3">Deskripsi</th>
                                        <th scope="col" class="px-4 py-3">Sumber dana</th>
                                        <th scope="col" class="px-4 py-3 text-right">Nominal</th>
                                    </tr>
                                </thead>
                                @foreach ($income as $item)
                                    <tbody>
                                        <tr class="bg-white border-b">
                                            <td class="px-4 py-3">{{ $item->date }}</td>
                                            <td class="px-4 py-3">{{ $item->description }}</td>
                                            <td class="px-4 py-3">{{ $item->source }}</td>
                                            <td class="px-4 py-3 text-right text-green-600">
                                                {{ number_format($item->amount, 0, ',', '.') }}</td>
                                        </tr>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <!-- Expense Section -->
                    <div class="bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-4 ml-4 mt-4">
                            <h3 class="text-lg font-semibold">EXPENSE</h3>
                            <button data-modal-target="crud-expense" data-modal-toggle="crud-expense" type="button"
                                class="flex items-center text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 mr-4">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Add
                            </button>
                            @include('shared.component.popup-expense')
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Tanggal</th>
                                        <th scope="col" class="px-4 py-3">Deskripsi</th>
                                        <th scope="col" class="px-4 py-3">Kategori</th>
                                        <th scope="col" class="px-4 py-3">Sumber Dana</th>
                                        <th scope="col" class="px-4 py-3 text-right">Nominal</th>
                                    </tr>
                                </thead>
                                @foreach ($expense as $item)
                                    <tbody>
                                        <tr class="bg-white border-b">
                                            <td class="px-4 py-3">{{ $item->date }}</td>
                                            <td class="px-4 py-3">{{ $item->description }}</td>
                                            <td class="px-4 py-3">{{ $item->category }}</td>
                                            <td class="px-4 py-3">DANA</td>
                                            <td class="px-4 py-3 text-right text-red-600">
                                                {{ number_format($item->amount, 0, ',', '.') }}</td>
                                        </tr>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chart = new ApexCharts(document.querySelector("#donut-chart"), {
                series: [{{ $percentageIncome }}, {{ $percentageExpense }}, {{ $percentageBalance }}],
                chart: {
                    height: 150,
                    width: 150,
                    type: "donut",
                    background: 'transparent',
                },
                labels: ["Keuntungan", "Pengeluaran", "Selisih"],
                colors: ["#4e79a7", "#f28e2c", "#8F5CD9"],
                legend: {
                    show: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '58%'
                        },
                        offsetX: -15
                    }
                },
                dataLabels: {
                    enabled: false
                },
                tooltip: {
                    enabled: false
                },
                stroke: {
                    width: 0
                },
                theme: {
                    mode: 'light'
                }
            });

            chart.render();
        });
    </script>
@endsection
