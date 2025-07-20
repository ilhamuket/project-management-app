<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1">
  <link rel="canonical" href="{{ url('/') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistem manajemen paket pekerjaan PSU Kabupaten Berau untuk pengelolaan dan pemantauan paket pekerjaan secara efisien.">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="twitter:site" content="@psuberau">
  <meta name="twitter:creator" content="@psuberau">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="PSU KABUPATEN BERAU PROJECT | Sistem Manajemen Paket Pekerjaan">
  <meta name="twitter:description" content="Sistem manajemen paket pekerjaan PSU Kabupaten Berau untuk pengelolaan dan pemantauan paket pekerjaan secara efisien.">
  <meta name="twitter:image" content="{{ asset('assets/img/og-image.png') }}">

  <meta property="og:url" content="{{ url('/') }}">
  <meta property="og:locale" content="id_ID">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="PSU Kabupaten Berau">
  <meta property="og:title" content="PSU KABUPATEN BERAU PROJECT | Sistem Manajemen Paket Pekerjaan">
  <meta property="og:description" content="Sistem manajemen paket pekerjaan PSU Kabupaten Berau untuk pengelolaan dan pemantauan paket pekerjaan secara efisien.">
  <meta property="og:image" content="{{ asset('assets/img/og-image.png') }}">

  <!-- Title -->
  <title>PSU KABUPATEN BERAU PROJECT | Sistem Manajemen Paket Pekerjaan</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <!-- Theme Check and Update -->
<script>
     const html = document.documentElement;
        html.classList.remove('dark');
        html.classList.add('light');
        localStorage.setItem('hs_theme', 'light');
</script>
  <!-- Apexcharts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css">
  <style type="text/css">
    .apexcharts-tooltip.apexcharts-theme-light {
      background-color: transparent !important;
      border: none !important;
      box-shadow: none !important;
    }
  </style>

  <!-- CSS HS -->
  <link rel="stylesheet" href="https://preline.co/assets/css/main.css?v=3.1.0">
</head>

<body class="bg-gray-50">
  @include('components.header')

  <!-- ========== MAIN CONTENT ========== -->
  @include('components.breadcrumb')

  @include('components.sidebar')

  <!-- Content -->
  <div class="w-full lg:ps-64">
    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
      @yield('content')
    </div>
  </div>
  <!-- End Content -->

  <!-- JS Implementing Plugins -->
  <!-- JS PLUGINS -->
  <!-- Required plugins -->
  <script src="https://cdn.jsdelivr.net/npm/preline/dist/index.js"></script>
  
  <!-- Apexcharts -->
  <script src="https://cdn.jsdelivr.net/npm/lodash/lodash.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/preline/dist/helper-apexcharts.js"></script>
  
  <!-- jQuery (Required untuk DataTables) -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  
  <!-- DataTables Buttons JS -->
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
  
  <!-- DataTables Responsive JS -->
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  @yield('scripts')

  <!-- JS THIRD PARTY PLUGINS -->
  <!-- Google Analytics. Global site tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-B73TDMXKF5"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
  
    function gtag() {
      dataLayer.push(arguments);
    }
  
    gtag('js', new Date());
    gtag('config', 'G-B73TDMXKF5');
  </script>
</body>
</html>