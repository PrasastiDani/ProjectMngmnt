<div class="chart-container p-6 rounded-lg shadow-md h-fit w-96" style="background: #DBE8F8;">
    <div class="chart-header">
        <h2 class="text-xl font-semibold">Rekap Bulanan</h2>
    </div>
    <div class="flex p-0">
        <div id="donut-chart"></div>
        <div class="flex-1 ml-2 mt-6">
            <div class="flex mb-2 items-center">
                <span class="legend-color" style="background-color: #4e79a7;"></span>
                <span class="legend-text">Keuntungan - {{ number_format($percentageIncome, 2) }}%</span>
            </div>
            <div class="flex mb-2 items-center">
                <span class="legend-color" style="background-color: #f28e2c;"></span>
                <span class="legend-text">Pengeluaran - {{ number_format($percentageExpense, 2) }}%</span>
            </div>
            <div class="flex mb-2 items-center">
                <span class="legend-color" style="background-color: #8F5CD9;"></span>
                <span class="legend-text">Selisih - {{ number_format($percentageBalance, 2) }}%</span>
            </div>
        </div>
    </div>
</div>
