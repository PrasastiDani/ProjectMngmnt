@extends('shared.layout.auth')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg p-8 w-96">
            <div class="text-black text-3xl font-bold">
                <h3 class="bg-green-500 w-40">Admin</h3>
            </div>
            <p class="text-gray-600">Please enter your details</p>
            <form class="mt-6" action="{{ route('auth.auth') }}" method="POST">
                @csrf
                {{-- Username --}}
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="username" id="username"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="username"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username
                    </label>
                    @error('username')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                {{-- end Username --}}
                {{-- Password --}}
                <div class="relative z-0 w-full group mb-8">
                    <input type="password" name="password" id="password"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="password"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                    {{-- show/hide password --}}
                    <div class="absolute inset-y-0 right-0 flex items-center px-2">
                        <button type="button" id="togglePassword" class="text-gray-600 focus:outline-none">
                            <!-- Visible Eye Icon -->
                            <svg id="eyeIcon" class="w-6 h-6" viewBox="0 0 165 167" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4 83.5C14.5105 50.0297 45.778 25.75 82.7215 25.75C119.665 25.75 150.932 50.0297 161.443 83.5C150.932 116.97 119.665 141.25 82.7215 141.25C45.778 141.25 14.5105 116.97 4 83.5ZM115.721 83.5C115.721 92.2521 112.245 100.646 106.056 106.835C99.8673 113.023 91.4736 116.5 82.7215 116.5C73.9694 116.5 65.5757 113.023 59.387 106.835C53.1983 100.646 49.7215 92.2521 49.7215 83.5C49.7215 74.7479 53.1983 66.3542 59.387 60.1655C65.5757 53.9768 73.9694 50.5 82.7215 50.5C91.4736 50.5 99.8673 53.9768 106.056 60.1655C112.245 66.3542 115.721 74.7479 115.721 83.5Z"
                                    fill="black" />
                                <path
                                    d="M82.5 100.05C86.8761 100.05 91.0729 98.3064 94.1673 95.2026C97.2616 92.0989 99 87.8893 99 83.5C99 79.1107 97.2616 74.9011 94.1673 71.7974C91.0729 68.6937 86.8761 66.95 82.5 66.95C78.1239 66.95 73.9271 68.6937 70.8327 71.7974C67.7384 74.9011 66 79.1107 66 83.5C66 87.8893 67.7384 92.0989 70.8327 95.2026C73.9271 98.3064 78.1239 100.05 82.5 100.05Z"
                                    fill="black" />
                            </svg>
                            </svg>

                            <!-- Hidden Eye Off Icon -->
                            <svg id="eyeOffIcon" class="w-6 h-6 hidden" viewBox="0 0 55 55" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.1941 6.30565C9.67549 5.80471 8.98084 5.52753 8.2598 5.5338C7.53875 5.54006 6.84902 5.82928 6.33915 6.33915C5.82928 6.84902 5.54006 7.53875 5.5338 8.2598C5.52753 8.98084 5.80471 9.67549 6.30565 10.1941L44.8056 48.6942C45.3243 49.1951 46.019 49.4723 46.74 49.466C47.461 49.4597 48.1508 49.1705 48.6606 48.6606C49.1705 48.1508 49.4597 47.461 49.466 46.74C49.4723 46.019 49.1951 45.3243 48.6942 44.8056L44.6434 40.7549C48.9266 37.3397 52.0939 32.7247 53.7404 27.4999C50.2369 16.3431 39.8144 8.2499 27.4999 8.2499C23.1891 8.24405 18.9378 9.256 15.0919 11.2034L10.1941 6.30565ZM21.9119 18.0206L26.0754 22.1869C27.0079 21.9393 27.9891 21.9409 28.9207 22.1917C29.8524 22.4424 30.7019 22.9335 31.3841 23.6157C32.0663 24.2979 32.5574 25.1474 32.8081 26.0791C33.0589 27.0107 33.0605 27.9919 32.8129 28.9244L36.9764 33.0879C38.2166 30.987 38.7232 28.5333 38.4164 26.113C38.1097 23.6927 37.007 21.443 35.2819 19.7179C33.5568 17.9928 31.3071 16.8901 28.8868 16.5834C26.4665 16.2766 24.0128 16.7804 21.9119 18.0206Z"
                                    fill="black" />
                                <path
                                    d="M34.2485 45.9169L26.8125 38.4781C24.1387 38.3106 21.6178 37.173 19.7232 35.2788C17.8285 33.3847 16.6903 30.8642 16.522 28.1904L6.42127 18.0896C4.0981 20.8561 2.34398 24.0541 1.25952 27.5001C4.76302 38.6568 15.1883 46.7501 27.5 46.7501C29.8293 46.7501 32.0898 46.4614 34.2485 45.9169Z"
                                    fill="black" />
                            </svg>
                            </svg>
                        </button>
                    </div>
                    {{-- end show/hide password --}}
                </div>
                {{-- end password --}}

                {{-- Login Button --}}
                <div>
                    <button type="submit"
                        class="w-full py-2 text-white bg-black rounded-md hover:bg-gray-800 focus:outline-none focus:bg-gray-800">Login</button>
                </div>
                {{-- End Login Button --}}
                <div>
                    @include('shared.component.toast')
                </div>
            </form>
        </div>
    </div>
@endsection
