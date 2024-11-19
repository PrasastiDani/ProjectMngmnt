<!-- Main modal -->
<div id="crud-expense" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900">
                    TAMBAHKAN PENGELUARAN
                </h3>
            </div>
            <!-- Modal body -->
            <form action="{{ route('expense.store') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                        <input type="date" name="date" id="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                        @error('date')
                            <span class="d-block text-danger mt-1"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                        <input type="text" name="description" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Deskripsi" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                        {{-- <input type="text" name="kategori" id="kategori"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="kategori" required=""> --}}
                        <div class="relative">
                            <select name="category" id="category"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                                <option selected>-- Pilih Kategori --</option>
                                <option value="COST">Biaya</option>
                                <option value="EXPENSE">Beban</option>
                            </select>
                            @error('category')
                                <span class="d-block text-danger mt-1"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="sumberdana" class="block mb-2 text-sm font-medium text-gray-900">Sumber Dana</label>
                        {{-- <input type="text" name="sumberdana" id="sumberdana"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Sumber Dana" required=""> --}}
                        <div class="relative">
                            <select name="source" id="category"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                                <option selected>-- Pilih Sumber Dana --</option>
                                <option value="BANK TRANSFER">Bank Transfer</option>
                                <option value="CASH">Cash</option>
                                <option value="OTHER">Lainnya</option>
                            </select>
                            @error('source')
                                <span class="d-block text-danger mt-1"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                        <input type="text" name="amount" id="amount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="100000" required="">
                        @error('amount')
                            <span class="d-block text-danger mt-1"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-row-reverse gap-2">
                    <button type="button" data-modal-hide="crud-expense"
                        class="flex items-center text-gray-500 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex items-center text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
