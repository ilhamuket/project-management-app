<!-- ========== HEADER ========== -->
<header class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full bg-white border-b border-gray-200 text-sm py-2.5 lg:ps-64">
  <nav class="px-4 sm:px-6 flex basis-full items-center w-full mx-auto">
    
    <!-- Mobile Logo & Sidebar Toggle -->
    <div class="flex items-center gap-x-3 lg:hidden">
      <!-- Sidebar Toggle Button -->
      <button type="button" class="text-gray-500 hover:text-gray-600" 
              data-hs-overlay="#hs-application-sidebar" 
              aria-controls="hs-application-sidebar" 
              aria-label="Toggle navigation">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18"/>
        </svg>
      </button>
      
      <!-- Mobile Logo -->
      <a class="flex items-center gap-x-2" href="{{ route('dashboard') }}" aria-label="Logo">
        <img src="{{ asset('assets/img/logo-berau.png') }}" class="w-7 h-7" alt="Logo Berau">
        <span class="text-sm font-bold text-gray-800">PSU BERAU</span>
      </a>
    </div>

    <div class="w-full flex items-center justify-end ms-auto md:justify-between gap-x-1 md:gap-x-3">

      <div class="hidden md:block">
        <!-- Search Input bisa ditambahkan di sini jika diperlukan -->
      </div>

      <div class="flex flex-row items-center justify-end gap-1">
        
        <!-- User Dropdown -->
        <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
          <button id="hs-dropdown-account" type="button" 
                  class="size-9 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none" 
                  aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            @if(Auth::user()->avatar ?? false)
              <img class="shrink-0 size-9 rounded-full" src="{{ Auth::user()->avatar }}" alt="Avatar {{ Auth::user()->name }}">
            @else
              <img class="shrink-0 size-9 rounded-full" src="{{ asset('assets/img/ava.png') }}" alt="Default Avatar">
            @endif
          </button>

          <div class="hs-dropdown-menu transition-[opacity,margin] duration-300 hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
            <div class="py-3 px-5 bg-gray-100 rounded-t-lg">
              <p class="text-sm text-gray-500">Login sebagai</p>
              <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
              <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>
            <div class="p-1.5 space-y-0.5">
              <!-- Divider -->
              <div class="border-t border-gray-200 my-1"></div>

              <!-- Logout Form -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                  </svg>
                  Logout
                </button>
              </form>
            </div>
          </div>
        </div>
        <!-- End Dropdown -->
        
      </div>
    </div>
  </nav>
</header>
<!-- ========== END HEADER ========== -->