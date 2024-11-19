<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 border-r-1 border-gray-300"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white border-r border-gray-200">
        <div class="text-black text-3xl font-bold mb-6">
            <h1 class="bg-green-500 pt-1 w-44">
                Dashboard
            </h1>
        </div>
        <hr class="border-t border-gray-300 my-2">
        <div class="text-xs font-semibold mb-2 text-gray-500 px-3">MAIN MENU</div>
        <ul class="space-y-1">
            <li>
                @include('shared.component.toast')
            </li>
            <li>
                <a href="{{ route('transaction.index') }}"
                    class="flex items-center p-2 rounded-lg group
                    {{ Route::currentRouteName() == 'transaction.index' ? 'bg-black text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <img src="/assets/transaksi.svg" alt="transaction icon"
                        class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-gray-900">
                    <span class="ms-3 text-sm">Transaksi</span>
                    <img src="/assets/arrow.svg" alt="arrow right icon" class="w-3 h-3 ms-auto text-white">
                </a>
            </li>
            <li>
                <a href="{{ route('accounting.index') }}"
                    class="flex items-center p-2 rounded-lg group
                    {{ Route::currentRouteName() == 'accounting.index' ? 'bg-black text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <img src="/assets/keuangan.svg" alt="accounting icon"
                        class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-gray-900">
                    <span class="flex-1 ms-3 text-sm whitespace-nowrap">Keuangan</span>
                    <img src="/assets/arrow.svg" alt="arrow right icon" class="w-3 h-3 ms-auto text-white">
                </a>
            </li>
            <li>
                <a href="{{ route('inventory.index') }}"
                    class="flex items-center p-2 rounded-lg group
                    {{ Route::currentRouteName() == 'inventory.index' ? 'bg-black text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <img src="/assets/asset.svg" alt="asset icon"
                        class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-gray-900">
                    <span class="flex-1 ms-3 text-sm whitespace-nowrap">Asset</span>
                    <img src="/assets/arrow.svg" alt="arrow right icon" class="w-3 h-3 ms-auto text-white">
                </a>
            </li>
        </ul>
        <div class="absolute bottom-0 left-0 w-full p-4 border-t border-gray-300">
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center p-2 rounded-lg group text-gray-700 hover:bg-gray-100">
                    <img src="/assets/sign-out-alt.svg" alt="logout icon"
                        class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-gray-900">
                    <span class="flex-1 ms-3 text-sm whitespace-nowrap">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
