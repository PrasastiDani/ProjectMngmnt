@extends('shared.layout.dashboard')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="container mx-auto">
            {{-- heading --}}
            @include('shared.component.header')
            {{-- end heading --}}
            {{-- grid --}}
            <div class="grid grid-cols-2 gap-2 mx-2">
                <div class="p-4 rounded-md" style="background-color: #EFEFEF;">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-lg font-medium">Booking</h4>
                        {{-- button group order --}}
                        @include('shared.component.btn-group-order')
                        {{-- end button group order --}}
                    </div>
                    {{-- card --}}
                    @foreach ($reserve as $item)
                        <div class="bg-white p-4 mt-4 rounded-md shadow-md h-fit w-full">
                            <div class="flex justify-between items-center mb-2">
                                <h2 class="font-bold">{{ $item->user->name }}</h2>
                                {{-- order status --}}
                                @if (\Carbon\Carbon::parse($item->created_at)->isToday())
                                    <div
                                        class="bg-red-200 text-red-800 text-sm font-semibold px-2 py-1 rounded-md inline-block mb-2">
                                        New Transaction
                                    </div>
                                @endif
                                {{-- end order status --}}
                                <span class="text-sm text-gray-500">{{ $item->created_at }}</span>
                            </div>
                            <p class="text-sm text-gray-700 mb-4">
                                {{ $item->note }}
                            </p>
                            <span class="font-bold">{{ $item->package->pakage_name }}/ {{ $item->title }}</span>
                            <div class="text-sm text-gray-600 my-2">
                                <div class="flex items-center">
                                    <img src="/assets/calendar-alt.svg" alt="calendar icon" class="w-4 h-4 mr-2" />
                                    {{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d F Y') }}
                                </div>
                                <div class="flex items-center">
                                    <img src="/assets/location.svg" alt="location icon" class="w-4 h-4 mr-2" />
                                    {{ $item->location }}
                                </div>
                                <div class="flex items-center">
                                    <img src="/assets/clock.svg" alt="clock icon" class="w-4 h-4 mr-2" />
                                    {{ $item->start_time }} - {{ $item->end_time }}
                                </div>
                                <div class="flex items-center">
                                    <img src="/assets/people.svg" alt="people icon" class="w-4 h-4 mr-2" />
                                    {{ $item->number_of_people }}
                                </div>
                            </div>
                            <div class="border-t border-gray-300 pt-2 text-sm text-gray-600">
                                <div class="flex justify-between mb-1">
                                    <span class="font-bold">Pembayaran</span>
                                    <span>{{ $item->payment->payment_method }}</span>
                                </div>
                                <div class="flex justify-between mb-1">
                                    <span class="font-bold">Nominal</span>
                                    <span>IDR {{ number_format($item->payment->amount, 0, ',', '.') }}</span>
                                </div>
                                @if ($item->payment->payment_method === 'Transfer Bank')
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-bold">Resi</span>
                                        <a href="#" target="_blank" class="text-blue-500">Lihat Resi</a>
                                    </div>
                                @endif
                                <div class="text-green-600 font-bold text-right">
                                    {{ $item->payment->status }}
                                </div>
                            </div>
                            <div class="mt-4">
                                {{-- upload gdrive link --}}
                                <form action="{{ route('transaction.store', ['reservationId' => $item->reservation_id]) }}"
                                    method="POST">
                                    @csrf
                                    {{-- check pakah sudah ada url --}}
                                    @php
                                        $existingHistory = App\Models\History::where(
                                            'reservation_id',
                                            $item->reservation_id,
                                        )->first();
                                    @endphp
                                    {{-- end checking --}}

                                    <input type="text" name="photo_link"
                                        placeholder="{{ $existingHistory ? $existingHistory->photo_link : 'Input link gdrive' }}"
                                        value="{{ $existingHistory ? $existingHistory->photo_link : '' }}"
                                        class="w-full border rounded-md p-2 text-sm {{ $errors->has('photo_link') ? 'border-red-500' : '' }}">
                                    @if ($errors->has('photo_link'))
                                        <span class="text-red-500 text-sm">{{ $errors->first('photo_link') }}</span>
                                    @endif
                                    <button class="bg-black text-white w-full mt-2 p-2 rounded-md">
                                        {{ $existingHistory ? 'Update' : 'Kirim' }}
                                    </button>
                                </form>
                                {{-- end upload gdrive link --}}
                            </div>
                        </div>
                    @endforeach
                    {{-- end card --}}
                </div>

                <div class="p-3 rounded-md h-fit" style="background-color: #EFEFEF;">
                    <h4 class="mb-4 text-lg font-medium">Jadwal & Agenda</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Calendar -->
                        <div class="bg-white p-4 rounded-md shadow-md h-fit">
                            <div class="flex justify-between items-center mb-2">
                                <button id="prevMonth"
                                    class="bg-white text-gray-500 px-2 py-1 rounded text-xs">&lt;</button>
                                <h2 id="calendarTitle" class="text-base font-bold"></h2>
                                <button id="nextMonth"
                                    class="bg-white text-gray-500 px-2 py-1 rounded text-xs">&gt;</button>
                            </div>
                            <hr class="border-gray-300 mb-2">
                            <div id="calendarGrid" class="grid grid-cols-7 gap-1">
                                <!-- Weekdays -->
                                <div class="text-center font-semibold text-xs">M</div>
                                <div class="text-center font-semibold text-xs">T</div>
                                <div class="text-center font-semibold text-xs">W</div>
                                <div class="text-center font-semibold text-xs">T</div>
                                <div class="text-center font-semibold text-xs">F</div>
                                <div class="text-center font-semibold text-xs">S</div>
                                <div class="text-center font-semibold text-xs">S</div>
                                <!-- Calendar days will be inserted here by JavaScript -->
                            </div>
                        </div>

                        <!-- Today -->
                        <div class="bg-white p-3 rounded-md shadow-md h-fit">
                            <!-- Header Section -->
                            <div class="flex items-center space-x-2 mt-1 mb-3">
                                <span class="font-bold text-sm">Agenda Bulan Ini</span>
                            </div>

                            <!-- Horizontal Line -->
                            <hr class="border-gray-300 mb-2">

                            <div class="overflow-y-auto" style="height: 168px">
                                <!-- Main Content Section -->
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-sm font-medium">Total Bookings:</h3>
                                    <p class="text-lg font-semibold text-black">{{ $totalReservations }}</p>
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-sm font-medium">Selesai:</h3>
                                    <p class="text-lg font-semibold text-green-500">{{ $completedReservations }}</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <h3 class="text-sm font-medium">Menunggu:</h3>
                                    <p class="text-lg font-semibold text-yellow-500">{{ $pendingReservations }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Upcoming - Now full width using col-span-2 -->
                        <div class="bg-white p-3 rounded-md shadow-md h-fit col-span-2">
                            <div class="mb-4">
                                <div class="bg-red-500 text-white text-center rounded-full py-1 mb-4">
                                    <h3 class="font-bold text-sm">TODAY</h3>
                                </div>
                                @foreach ($todayReservations as $item)
                                    <div class="flex items-center mb-2">
                                        <div class="text-red-500 font-bold text-3xl mr-2">
                                            <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($item->event_date)->format('M') }}</p>
                                            <p>{{ \Carbon\Carbon::parse($item->event_date)->format('d') }}</p>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-sm">{{ $item->user->name }}</h4>
                                            <p class="text-xs text-gray-500">{{ $item->title }}</p>
                                            <p class="text-xs text-gray-500 flex items-center">
                                                <img src="/assets/clock.svg" alt="clock icon" class="w-4 h-4 mr-2" />
                                                {{ $item->start_time }} - {{ $item->end_time }}
                                            </p>
                                            <p class="text-xs text-gray-500 flex items-center">
                                                <img src="/assets/location.svg" alt="clock icon" class="w-4 h-4 mr-2" />
                                                {{ $item->location }}
                                            </p>
                                        </div>
                                    </div>
                                    <hr class="border-gray-300 mb-6">
                                @endforeach
                            </div>


                            {{-- <!-- Upcoming Section -->
                            <div class="mb-6">
                                <div class="bg-blue-500 text-white text-center rounded-full py-1 mb-4">
                                    <h3 class="font-bold text-sm">UPCOMING</h3>
                                </div>
                                <div class="flex items-center mb-2">
                                    <div class="text-blue-500 font-bold text-3xl mr-2">
                                        <p class="text-xs text-gray-400">SEP</p>
                                        <p>26</p>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-sm">CLAUDIO ORLANDO</h4>
                                        <p class="text-xs text-gray-500 mb-1">Perkumpulan mahasiswa NTT UTY</p>
                                        <p class="text-xs text-gray-500 flex items-center">
                                            <img src="/assets/clock.svg" alt="clock icon" class="w-4 h-4 mr-2" />
                                            09:00 - 11:00 WIB
                                        </p>
                                        <p class="text-xs text-gray-500 flex items-center">
                                            <img src="/assets/location.svg" alt="clock icon" class="w-4 h-4 mr-2" />
                                            Parkiran UTY Kampus 1
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <hr class="border-gray-300 mb-6">

                            <!-- Passed Section -->
                            <div class="mb-6">
                                <div class="bg-green-500 text-white text-center rounded-full py-1 mb-4">
                                    <h3 class="font-bold text-sm">PASSED</h3>
                                </div>
                                <div class="flex items-center mb-2">
                                    <div class="text-green-500 font-bold text-3xl mr-2">
                                        <p class="text-xs text-gray-400">SEP</p>
                                        <p>26</p>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-sm">CLAUDIO ORLANDO</h4>
                                        <p class="text-xs text-gray-500 mb-1">Perkumpulan mahasiswa NTT UTY</p>
                                        <p class="text-xs text-gray-500 flex items-center">
                                            <img src="/assets/clock.svg" alt="clock icon" class="w-4 h-4 mr-2" />
                                            09:00 - 11:00 WIB
                                        </p>
                                        <p class="text-xs text-gray-500 flex items-center">
                                            <img src="/assets/location.svg" alt="clock icon" class="w-4 h-4 mr-2" />
                                            Parkiran UTY Kampus 1
                                        </p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>
            {{-- end grid --}}
        </div>

    </div>
@endsection
