@extends('layouts.app')

@section('content')
  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    <!-- Card - Total Paket Pekerjaan -->
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
      <div class="p-4 md:p-5">
        <div class="flex items-center gap-x-2">
          <p class="text-xs uppercase text-gray-500">
            Total Paket Pekerjaan
          </p>
          <div class="hs-tooltip">
            <div class="hs-tooltip-toggle">
              <svg class="shrink-0 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                <path d="M12 17h.01" />
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs" role="tooltip">
                Jumlah total paket pekerjaan yang terdaftar
              </span>
            </div>
          </div>
        </div>

        <div class="mt-1 flex items-center gap-x-2">
          <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
            {{ number_format($stats['total_paket_pekerjaan']) }}
          </h3>
          @if($stats['total_change'] != 0)
            <span class="flex items-center gap-x-1 {{ $stats['total_change'] > 0 ? 'text-green-600' : 'text-red-600' }}">
              <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                @if($stats['total_change'] > 0)
                  <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" />
                  <polyline points="16 7 22 7 22 13" />
                @else
                  <polyline points="22 17 13.5 8.5 8.5 13.5 2 7" />
                  <polyline points="16 17 22 17 22 11" />
                @endif
              </svg>
              <span class="inline-block text-sm">
                {{ abs($stats['total_change']) }}%
              </span>
            </span>
          @endif
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card - Paket Pekerjaan Berlangsung -->
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
      <div class="p-4 md:p-5">
        <div class="flex items-center gap-x-2">
          <p class="text-xs uppercase text-gray-500">
            Paket Pekerjaan Berlangsung
          </p>
        </div>

        <div class="mt-1 flex items-center gap-x-2">
          <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
            {{ number_format($stats['paket_berlangsung']) }}
          </h3>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card - Paket Pekerjaan Selesai -->
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
      <div class="p-4 md:p-5">
        <div class="flex items-center gap-x-2">
          <p class="text-xs uppercase text-gray-500">
            Paket Pekerjaan Selesai
          </p>
        </div>

        <div class="mt-1 flex items-center gap-x-2">
          <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
            {{ number_format($stats['paket_selesai']) }}
          </h3>
          @if($stats['completed_change'] != 0)
            <span class="flex items-center gap-x-1 {{ $stats['completed_change'] > 0 ? 'text-green-600' : 'text-red-600' }}">
              <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                @if($stats['completed_change'] > 0)
                  <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" />
                  <polyline points="16 7 22 7 22 13" />
                @else
                  <polyline points="22 17 13.5 8.5 8.5 13.5 2 7" />
                  <polyline points="16 17 22 17 22 11" />
                @endif
              </svg>
              <span class="inline-block text-sm">
                {{ abs($stats['completed_change']) }}%
              </span>
            </span>
          @endif
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card - Total Nilai Kontrak -->
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
      <div class="p-4 md:p-5">
        <div class="flex items-center gap-x-2">
          <p class="text-xs uppercase text-gray-500">
            Total Nilai Kontrak
          </p>
        </div>

        <div class="mt-1 flex items-center gap-x-2">
          <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
            @if($stats['total_nilai_kontrak'] >= 1000000000)
              Rp {{ number_format($stats['total_nilai_kontrak'] / 1000000000, 1) }}M
            @elseif($stats['total_nilai_kontrak'] >= 1000000)
              Rp {{ number_format($stats['total_nilai_kontrak'] / 1000000, 1) }}Jt
            @else
              Rp {{ number_format($stats['total_nilai_kontrak'], 0, ',', '.') }}
            @endif
          </h3>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Grid -->

  <div class="grid lg:grid-cols-2 gap-4 sm:gap-6">
    <!-- Card - Status Paket Pekerjaan per Bulan -->
    <div class="p-4 md:p-5 min-h-102.5 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
      <!-- Header -->
      <div class="flex flex-wrap justify-between items-center gap-2">
        <div>
          <h2 class="text-sm text-gray-500">
            Status Paket Pekerjaan per Bulan
          </h2>
          <p class="text-xl sm:text-2xl font-medium text-gray-800">
            {{ $year }}
          </p>
        </div>

        <div>
          <select id="yearSelector" class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
            @for($i = date('Y'); $i >= date('Y') - 5; $i--)
              <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
          </select>
        </div>
      </div>
      <!-- End Header -->

      <div id="hs-multiple-bar-charts"></div>
    </div>
    <!-- End Card -->

    <!-- Card - Total Paket Pekerjaan per Bulan -->
    <div class="p-4 md:p-5 min-h-102.5 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
      <!-- Header -->
      <div class="flex flex-wrap justify-between items-center gap-2">
        <div>
          <h2 class="text-sm text-gray-500">
            Total Paket Pekerjaan per Bulan
          </h2>
          <p class="text-xl sm:text-2xl font-medium text-gray-800">
            {{ array_sum(array_column($totalProjectsPerMonth, 'total')) }}
          </p>
        </div>
      </div>
      <!-- End Header -->

      <div id="hs-single-area-chart"></div>
    </div>
    <!-- End Card -->
  </div>

  <!-- Card - Top 10 Paket Pekerjaan Berjalan -->
  <div class="p-4 md:p-5 bg-white border border-gray-200 shadow-2xs rounded-xl">
    <div class="flex flex-wrap justify-between items-center gap-2 mb-4">
      <div>
        <h2 class="text-sm text-gray-500">
          Top 10 Paket Pekerjaan Sedang Berjalan
        </h2>
        <p class="text-xl sm:text-2xl font-medium text-gray-800">
          Berdasarkan Nilai Kontrak
        </p>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Paket Pekerjaan</th>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Kontraktor</th>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nilai Kontrak</th>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Progress</th>
            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Alamat</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($topRunningProjects as $index => $project)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                {{ $index + 1 }}
              </td>
                <td class="px-6 py-4 text-sm text-gray-800">
                <div class="max-w-xs">
                  <a href="{{ route('projects.show', $project->id) }}" class="font-medium text-blue-600 hover:text-blue-800 hover:underline">
                  {{ $project->paket_pekerjaan }}
                  </a>
                </div>
                </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                {{ $project->nama_kontraktor ?? '-' }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                {{ $project->nilai_kontrak_formatted }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                <div class="flex items-center gap-x-2">
                  <div class="flex-1 bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $project->progress_percentage }}%"></div>
                  </div>
                  <span class="text-xs">{{ $project->progress_percentage }}%</span>
                </div>
              </td>
              <td class="px-6 py-4 text-sm text-gray-800">
                <div class="max-w-xs">
                  {{ Str::limit($project->alamat, 50) }}
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                Tidak ada paket pekerjaan yang sedang berjalan
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!-- End Card -->
@endsection

@section('scripts')
  <script>
    let monthlyProjectChart;
    let totalProjectChart;

    // Data from server with validation
    const monthlyProjectData = @json($monthlyProjectData ?? []);
    const totalProjectsPerMonth = @json($totalProjectsPerMonth ?? []);

    window.addEventListener("load", () => {
      // Initialize charts only if data exists
      if (monthlyProjectData.length > 0) {
        initializeMonthlyProjectChart();
      }
      
      if (totalProjectsPerMonth.length > 0) {
        initializeTotalProjectChart();
      }

      // Year selector change event
      const yearSelector = document.getElementById('yearSelector');
      if (yearSelector) {
        yearSelector.addEventListener('change', function() {
          const selectedYear = this.value;
          window.location.href = `{{ route('dashboard') }}?year=${selectedYear}`;
        });
      }
    });

    function initializeMonthlyProjectChart() {
      // Prepare data for multiple bar chart with validation
      const categories = monthlyProjectData.map(item => item.month_name || '');
      const belumDimulaiData = monthlyProjectData.map(item => parseInt(item.belum_dimulai) || 0);
      const progressData = monthlyProjectData.map(item => parseInt(item.progress) || 0);
      const selesaiData = monthlyProjectData.map(item => parseInt(item.selesai) || 0);

      if (categories.length === 0) {
        console.warn('No data available for monthly project chart');
        return;
      }

      monthlyProjectChart = buildChart(
        "#hs-multiple-bar-charts",
        () => ({
          chart: {
            type: "bar",
            height: 300,
            toolbar: {
              show: false,
            },
            zoom: {
              enabled: false,
            },
          },
          series: [
            {
              name: "Belum Dimulai",
              data: belumDimulaiData,
            },
            {
              name: "Progress",
              data: progressData,
            },
            {
              name: "Selesai",
              data: selesaiData,
            },
          ],
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: "16px",
              borderRadius: 0,
            },
          },
          legend: {
            show: true,
            position: 'top',
          },
          dataLabels: {
            enabled: false,
          },
          stroke: {
            show: true,
            width: 8,
            colors: ["transparent"],
          },
          xaxis: {
            categories: categories,
            axisBorder: {
              show: false,
            },
            axisTicks: {
              show: false,
            },
            crosshairs: {
              show: false,
            },
            labels: {
              style: {
                colors: "#9ca3af",
                fontSize: "13px",
                fontFamily: "Inter, ui-sans-serif",
                fontWeight: 400,
              },
              offsetX: -2,
              formatter: (title) => {
                if (title && typeof title === 'string') {
                  return title.slice(0, 3);
                }
                return title || '';
              },
            },
          },
          yaxis: {
            labels: {
              align: "left",
              minWidth: 0,
              maxWidth: 140,
              style: {
                colors: "#9ca3af",
                fontSize: "13px",
                fontFamily: "Inter, ui-sans-serif",
                fontWeight: 400,
              },
              formatter: (value) => {
                return Number.isInteger(value) ? value.toString() : '';
              },
            },
          },
          states: {
            hover: {
              filter: {
                type: "darken",
                value: 0.9,
              },
            },
          },
          tooltip: {
            y: {
              formatter: (value) => `${value || 0} paket`,
            },
          },
          responsive: [
            {
              breakpoint: 568,
              options: {
                chart: {
                  height: 300,
                },
                plotOptions: {
                  bar: {
                    columnWidth: "14px",
                  },
                },
                stroke: {
                  width: 8,
                },
                xaxis: {
                  labels: {
                    style: {
                      colors: "#9ca3af",
                      fontSize: "11px",
                      fontFamily: "Inter, ui-sans-serif",
                      fontWeight: 400,
                    },
                    offsetX: -2,
                    formatter: (title) => {
                      if (title && typeof title === 'string') {
                        return title.slice(0, 3);
                      }
                      return title || '';
                    },
                  },
                },
                yaxis: {
                  labels: {
                    align: "left",
                    minWidth: 0,
                    maxWidth: 140,
                    style: {
                      colors: "#9ca3af",
                      fontSize: "11px",
                      fontFamily: "Inter, ui-sans-serif",
                      fontWeight: 400,
                    },
                    formatter: (value) => {
                      return Number.isInteger(value) ? value.toString() : '';
                    },
                  },
                },
              },
            },
          ],
        }),
        {
          colors: ["#ef4444", "#3b82f6", "#10b981"],
          grid: {
            borderColor: "#e5e7eb",
          },
        }
      );
    }

    function initializeTotalProjectChart() {
      // Prepare data for area chart with validation
      const categories = totalProjectsPerMonth.map(item => item.month_name || '');
      const totals = totalProjectsPerMonth.map(item => parseInt(item.total) || 0);

      if (categories.length === 0) {
        console.warn('No data available for total project chart');
        return;
      }

      totalProjectChart = buildChart(
        "#hs-single-area-chart",
        () => ({
          chart: {
            height: 300,
            type: "area",
            toolbar: {
              show: false,
            },
            zoom: {
              enabled: false,
            },
          },
          series: [
            {
              name: "Total Paket Pekerjaan",
              data: totals,
            },
          ],
          legend: {
            show: false,
          },
          dataLabels: {
            enabled: false,
          },
          stroke: {
            curve: "smooth",
            width: 2,
          },
          grid: {
            strokeDashArray: 2,
          },
          fill: {
            type: "gradient",
            gradient: {
              type: "vertical",
              shadeIntensity: 1,
              opacityFrom: 0.1,
              opacityTo: 0.8,
            },
          },
          xaxis: {
            type: "category",
            tickPlacement: "on",
            categories: categories,
            axisBorder: {
              show: false,
            },
            axisTicks: {
              show: false,
            },
            labels: {
              style: {
                colors: "#9ca3af",
                fontSize: "13px",
                fontFamily: "Inter, ui-sans-serif",
                fontWeight: 400,
              },
              formatter: (title) => {
                if (title && typeof title === 'string') {
                  return title.slice(0, 3);
                }
                return title || '';
              },
            },
          },
          yaxis: {
            labels: {
              align: "left",
              minWidth: 0,
              maxWidth: 140,
              style: {
                colors: "#9ca3af",
                fontSize: "13px",
                fontFamily: "Inter, ui-sans-serif",
                fontWeight: 400,
              },
              formatter: (value) => {
                return Number.isInteger(value) ? value.toString() : '';
              },
            },
          },
          tooltip: {
            y: {
              formatter: (value) => `${value || 0} paket`,
            },
          },
          responsive: [
            {
              breakpoint: 568,
              options: {
                chart: {
                  height: 300,
                },
                xaxis: {
                  labels: {
                    style: {
                      colors: "#9ca3af",
                      fontSize: "11px",
                      fontFamily: "Inter, ui-sans-serif",
                      fontWeight: 400,
                    },
                    formatter: (title) => {
                      if (title && typeof title === 'string') {
                        return title.slice(0, 3);
                      }
                      return title || '';
                    },
                  },
                },
                yaxis: {
                  labels: {
                    align: "left",
                    minWidth: 0,
                    maxWidth: 140,
                    style: {
                      colors: "#9ca3af",
                      fontSize: "11px",
                      fontFamily: "Inter, ui-sans-serif",
                      fontWeight: 400,
                    },
                    formatter: (value) => {
                      return Number.isInteger(value) ? value.toString() : '';
                    },
                  },
                },
              },
            },
          ],
        }),
        {
          colors: ["#2563eb"],
          fill: {
            gradient: {
              stops: [0, 90, 100],
            },
          },
          grid: {
            borderColor: "#e5e7eb",
          },
        }
      );
    }

    // Error handling for chart initialization
    window.addEventListener('error', function(e) {
      if (e.message.includes('buildChart')) {
        console.error('Chart initialization failed:', e);
        // You can add fallback behavior here
      }
    });
  </script>
@endsection
