<!-- Sidebar -->
<div id="hs-application-sidebar" class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform w-64 h-full hidden fixed inset-y-0 start-0 z-60 bg-white border-e border-gray-200 lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 dark:bg-neutral-800 dark:border-neutral-700" role="dialog" tabindex="-1" aria-label="Sidebar">
  <div class="relative flex flex-col h-full max-h-full">
    
    <!-- Sidebar Header -->
    <div class="px-6 pt-4 flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center gap-x-3">
        <a class="flex-none" href="{{ route('dashboard') }}" aria-label="Logo">
          <img src="{{ asset('assets/img/logo-berau.png') }}" class="w-10 h-auto" alt="Logo">
        </a>
        <span class="text-lg font-bold text-gray-800 whitespace-nowrap dark:text-white">PSU KAB. BERAU</span>
      </div>
      
      <!-- Close Button (Mobile Only) -->
      <button type="button" class="lg:hidden text-gray-500 hover:text-gray-600 dark:text-neutral-400 dark:hover:text-neutral-300" 
              data-hs-overlay="#hs-application-sidebar" 
              aria-controls="hs-application-sidebar" 
              aria-label="Close sidebar">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Content -->
    <div class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
      <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul class="flex flex-col space-y-1">
          
          <!-- Dashboard -->
          <li>
            <a class="flex items-center gap-x-3.5 py-2 px-2.5 {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-neutral-700' : '' }} text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-{{ request()->routeIs('dashboard') ? 'white' : 'neutral-200' }}" href="{{ route('dashboard') }}">
              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
              </svg>
              Dasbor
            </a>
          </li>

          <!-- Paket Pekerjaan -->
          <li class="hs-accordion" id="projects-accordion">
            <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 {{ request()->routeIs('projects.*') ? 'bg-gray-100 dark:bg-neutral-700' : 'dark:bg-neutral-800' }} dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-{{ request()->routeIs('projects.*') ? 'white' : 'neutral-200' }}" 
                    aria-expanded="{{ request()->routeIs('projects.*') ? 'true' : 'false' }}" 
                    aria-controls="projects-accordion-child">
              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2-2v16" />
              </svg>
              Paket Pekerjaan

              <svg class="hs-accordion-active:block ms-auto hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m18 15-6-6-6 6" />
              </svg>

              <svg class="hs-accordion-active:hidden ms-auto block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </button>

            <div id="projects-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 {{ request()->routeIs('projects.*') ? '' : 'hidden' }}" role="region" aria-labelledby="projects-accordion">
              <ul class="ps-8 pt-1 space-y-1">
                <li>
                  <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 {{ request()->routeIs('projects.index') ? 'bg-gray-100 dark:bg-neutral-700' : 'dark:bg-neutral-800' }} dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-{{ request()->routeIs('projects.index') ? 'white' : 'neutral-200' }}" href="{{ route('projects.index') }}">
                    Manajemen Paket Pekerjaan
                  </a>
                </li>
              </ul>
            </div>
          </li>

        </ul>
      </nav>
    </div>
    <!-- End Content -->
  </div>
</div>
<!-- End Sidebar -->