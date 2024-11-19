<!-- Main modal -->
<div id="crud-asset" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900">
                    TAMBAHKAN ASSET
                </h3>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ route('inventory.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="asset_name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                        <input type="text" name="asset_name" id="asset_name"
                            value="{{ old('asset_name', $asset->asset_name ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan nama asset" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                        <select id="category" name="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:border-gray-500 dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Pilih Kategori</option>
                            <option value="operasional" {{ old('category', $asset->category ?? '') == 'operasional' ? 'selected' : '' }}>Asset Operasional</option>
                            <option value="nonoperasional" {{ old('category', $asset->category ?? '') == 'nonoperasional' ? 'selected' : '' }}>Asset Non-Operasional</option>
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="purchase_cost" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                        <input type="number" name="purchase_cost" id="purchase_cost"
                            value="{{ old('purchase_cost', $asset->purchase_cost ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-500 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="IDR 1000000" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="purchase_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                        <input type="date" name="purchase_date" id="purchase_date"
                            value="{{ old('purchase_date', $asset->purchase_date ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:border-gray-500 dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Pilih Status</option>
                            <option value="sangat_baik" {{ old('status', $asset->status ?? '') == 'sangat_baik' ? 'selected' : '' }}>Sangat Baik</option>
                            <option value="cukup_baik" {{ old('status', $asset->status ?? '') == 'cukup_baik' ? 'selected' : '' }}>Cukup Baik</option>
                            <option value="baik" {{ old('status', $asset->status ?? '') == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="cukup_buruk" {{ old('status', $asset->status ?? '') == 'cukup_buruk' ? 'selected' : '' }}>Cukup Buruk</option>
                            <option value="sangat_buruk" {{ old('status', $asset->status ?? '') == 'sangat_buruk' ? 'selected' : '' }}>Sangat Buruk</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Barang</label>
                        <textarea id="description" name="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Tulis deskripsi barang">{{ old('description', $asset->description ?? '') }}</textarea>
                    </div>
                </div>
                <div class="flex flex-row-reverse gap-2">
                    <button type="button" data-modal-hide="crud-asset"
                        class="flex items-center text-gray-500 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex items-center text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
