<!-- Breadcrumb -->
<div class="sticky top-16 inset-x-0 z-20 bg-white border-b border-gray-200 px-4 sm:px-6 lg:px-8 lg:hidden">
  <div class="flex items-center py-3">
    
    <!-- Breadcrumb Navigation -->
    <nav aria-label="Breadcrumb" class="flex items-center space-x-1 text-sm text-gray-500">
      <a href="{{ route('dashboard') }}" class="flex items-center hover:text-gray-700 transition-colors">
        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
          <polyline points="9 22 9 12 15 12 15 22" />
        </svg>
        Beranda
      </a>
      
      @if(!request()->routeIs('dashboard'))
        <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" />
        </svg>
        
        <span class="font-medium text-gray-800">
          @if(isset($title))
            {{ $title }}
          @else
            @php
              $routeName = Route::currentRouteName();
              $segments = explode('.', $routeName);
              $lastSegment = end($segments);
              
              // Custom mapping untuk nama breadcrumb yang lebih user-friendly
              $breadcrumbMapping = [
                'index' => 'Daftar',
                'create' => 'Tambah Baru',
                'edit' => 'Edit',
                'show' => 'Detail',
                'projects' => 'Paket Pekerjaan',
              ];
              
              if (count($segments) > 1) {
                $parentSegment = $segments[0];
                $childSegment = $segments[1];
                
                $parentName = $breadcrumbMapping[$parentSegment] ?? ucfirst($parentSegment);
                $childName = $breadcrumbMapping[$childSegment] ?? ucfirst($childSegment);
                
                echo $parentName . ' - ' . $childName;
              } else {
                echo $breadcrumbMapping[$lastSegment] ?? ucfirst($lastSegment);
              }
            @endphp
          @endif
        </span>
      @endif
    </nav>
    
  </div>
</div>
<!-- End Breadcrumb -->