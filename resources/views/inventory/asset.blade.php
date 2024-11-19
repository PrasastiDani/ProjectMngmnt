@extends('shared.layout.dashboard')

@section('content')
    <div class="p-4 sm:ml-64 flex-1 overflow-auto">
        <div class="flex-1 p-4">
            {{-- heading --}}
            @include('shared.component.header')
            {{-- end heading --}}

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
                {{-- card total harga aset --}}
                <div class="rounded-lg shadow p-4" style="background-color: #E8F6EC;">
                    <h3 class="text-sm font-normal text-gray-600">Total Jumlah Harga Asset</h3>
                    <p class="text-3xl font-bold">IDR {{ number_format($totalPrice, 0, ',', '.') }}</p>
                </div>
                {{-- end card total harga aset --}}

                {{-- card total aset --}}
                <div class="rounded-lg shadow p-4" style="background-color: #EFDECB;">
                    <h3 class="text-sm font-normal text-gray-600">Total Jumlah Asset</h3>
                    <p class="text-3xl font-bold">{{ $totalAssets }}</p>
                </div>
                {{-- end total aset --}}
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h2 class="text-2xl font-bold">ASSET</h2>
                            <p class="text-sm text-gray-600">Tabel Perhitungan Asset</p>
                        </div>
                        <div class="flex space-x-2">
                            <button data-modal-target="crud-asset" data-modal-toggle="crud-asset" type="button"
                                class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambahkan Asset
                            </button>
                            <button type="button" onclick="document.getElementById('delete-form').submit();"
                                class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Delete
                            </button>
                            @include('shared.component.popup-add-asset')
                        </div>
                    </div>
                    <form id="delete-form" action="{{ route('inventory.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="overflow-x-auto mt-4">
                            <table class="w-full text-sm text-left">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                                    onclick="toggleSelectAll(this)">
                                                <label for="checkbox-all" class="sr-only">checkbox</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">Nama Asset</th>
                                        <th scope="col" class="px-6 py-3">Kategori</th>
                                        <th scope="col" class="px-6 py-3">Harga Beli</th>
                                        <th scope="col" class="px-6 py-3">Tanggal Pembelian</th>
                                        <th scope="col" class="px-6 py-3">Deskripsi</th>
                                        <th scope="col" class="px-6 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assets as $item)
                                        <tr class="bg-white border-b">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="asset_ids[]" value="{{ $item->asset_id }}"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                    <label class="sr-only">checkbox</label>
                                                </div>
                                            </td>
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $item->asset_name }}</th>
                                            <td class="px-6 py-4">{{ $item->category }}</td>
                                            <td class="px-6 py-4">IDR {{ number_format($item->purchase_cost, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">{{ $item->purchase_date }}</td>
                                            <td class="px-6 py-4">{{ $item->description }}</td>
                                            <td class="px-6 py-4">{{ $item->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSelectAll(source) {
            const checkboxes = document.getElementsByName('asset_ids[]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }
    </script>
@endsection
