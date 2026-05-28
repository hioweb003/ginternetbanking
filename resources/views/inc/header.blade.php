 <!-- Top Nav -->
       <header class="flex justify-between items-center bg-white dark:bg-gray-800 p-4 shadow sticky top-0 z-10">
            <div class="flex items-center space-x-3 md:block hidden">
                <!-- Sidebar Toggle Button -->
                <button onclick="toggleSidebar()" class="md:hidden text-gray-700 dark:text-gray-200">
                    <i class="fa fa-bars text-xl"></i>
                </button>
                {{-- <h1 class="text-xl font-semibold text-gray-700 dark:text-gray-200">Dashboard</h1> --}}
            </div>

            <div class="flex items-center space-x-4">

                <!-- Test / Live Toggle -->
                {{-- <div class="flex items-center bg-gray-200 dark:bg-gray-700 rounded-full p-1 text-xs font-semibold">
                    <button id="testBtn" onclick="setMode('test')" class="px-3 py-1 rounded-full bg-yellow-400 text-black transition">TEST</button>
                    <button id="liveBtn" onclick="setMode('live')" class="px-3 py-1 rounded-full text-gray-600 dark:text-gray-300 transition">LIVE</button>
                </div>  --}}
                
           
                <div class="flex items-center space-x-2">
                    @if (!request()->routeIs('userprofile'))
                        <img src="{{ session('details')['profilepic'] ?? asset('img/userface.jpg') }}" class="w-8 h-8 rounded-full object-cover">
                    @endif
                    <span class="block md:hidden text-gray-700 dark:text-gray-200">{{"Hi ".ucwords(session('details')["first_name"] ?? "")}}</span>
                </div>
            </div>
        </header>
         