@extends('layouts.app')

@section('content')

<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden">
                <!-- Header -->
                <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            Paket Pekerjaan
                        </h2>
                        <p class="text-sm text-gray-600">
                            Tambah paket pekerjaan, edit dan lainnya.
                        </p>
                    </div>

                    <div>
                        <div class="inline-flex gap-x-2">

                            <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('projects.create') }}">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                                Buat
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End Header -->

                <!-- Table -->
                <table id="projects-table" class="min-w-full divide-y divide-gray-200 responsive nowrap">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="w-10 px-3"></th>
                            <th scope="col" class="ps-6 py-3 text-start">
                                No
                            </th>
                            <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase text-gray-800">
                                        Paket Pekerjaan
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase text-gray-800">
                                        Waktu
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase text-gray-800">
                                        Status
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase text-gray-800">
                                        Nilai Kontrak
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase text-gray-800">
                                        Alamat
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Data will be loaded by DataTables -->
                    </tbody>
                </table>
                <!-- End Table -->

                <!-- Footer with pagination will be added by DataTables -->
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded z-50" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    <script>
        setTimeout(function() {
            const alert = document.querySelector('[role="alert"]');
            if (alert) alert.remove();
        }, 3000);
    </script>
@endif
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<style>
/* Modern DataTables styling */
.dataTables_wrapper {
    padding: 1.5rem;
    font-family: inherit;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 1.5rem;
}

.dataTables_wrapper .dataTables_length select {
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    padding: 0.5rem 2rem 0.5rem 1rem;
    background-position: right 0.5rem center;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-size: 1.5rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    font-size: 0.875rem;
}

.dataTables_wrapper .dataTables_filter {
    margin-bottom: 1.5rem;
}

.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    min-width: 240px;
}


.dataTables_wrapper .dataTables_paginate {
    padding: 1rem 0;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    border-radius: 0.375rem !important;
    border: 1px solid #e5e7eb !important;
    background: #ffffff !important;
    color: #374151 !important;
    padding: 0.5rem 0.75rem !important;
    margin: 0 0.25rem;
    font-weight: 500;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #3b82f6 !important;
    color: #ffffff !important;
    border-color: #3b82f6 !important;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled):not(.current) {
    background: #f3f4f6 !important;
    color: #111827 !important;
    border-color: #d1d5db !important;
}

table.dataTable {
    border-collapse: separate !important;
    border-spacing: 0 !important;
}

table.dataTable thead th {
    border-bottom: none !important;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 0.75rem 1rem;
    background-color: #f9fafb;
    font-weight: 600;
}

table.dataTable tbody tr:last-child td {
    border-bottom: none;
}

table.dataTable tbody tr:hover {
    background-color: #f9fafb !important;
}

/* Make text color darker and more visible */
table.dataTable tbody td {
    padding: 1rem !important;
    vertical-align: middle;
    border-bottom: 1px solid #f3f4f6;
    font-size: 0.875rem;
    color: #000000; /* Change to black for better visibility */
}

/* Fix other gray text instances in the table */
.dataTables_wrapper .dataTables_info {
    font-size: 0.875rem;
    color: #000000; /* Changed from #6b7280 */
    padding: 1rem 0;
}

/* Ensure consistent text coloring in renders */
table.dataTable .text-sm,
table.dataTable .text-xs,
table.dataTable .text-gray-900 {
    color: #000000;
}

/* Improve responsive controls */
table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before,
table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control:before {
    margin-right: 0;
    background-color: #3b82f6;
    border: 1px solid #3b82f6;
    box-shadow: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    line-height: 16px;
    text-align: center;
}

/* First column with expand button */
table.dataTable td.dtr-control {
    padding-left: 15px !important;
    position: relative;
    cursor: pointer;
}
</style>

<script>
function deleteProject(id) {
    if(confirm('Apakah Anda yakin ingin menghapus paket pekerjaan ini?')) {
        // Create a form for DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/projects/${id}`;
        form.style.display = 'none';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

$(document).ready(function() {
    // Initialize DataTables
    let table = $('#projects-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true, // Enable responsive features
        ajax: {
            url: "{{ route('projects.data') }}",
            type: "GET"
        },
        columns: [
            {
                className: 'dtr-control',
                orderable: false,
                data: null,
                defaultContent: '',
                responsivePriority: 1
            },
            {
                data: null,
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                responsivePriority: 2,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { 
                data: 'paket_pekerjaan', 
                name: 'paket_pekerjaan',
                responsivePriority: 3,
                render: function(data, type, row) {
                    return `<div class="flex items-center gap-x-3">
                              <div class="grow">
                                <a href="/projects/${row.id}" class="block text-sm text-blue-600 hover:underline">${data}</a>
                                <span class="block text-sm ">${row.jenis_konstruksi}</span>
                              </div>
                            </div>`;
                }
            },
            { 
                data: 'waktu', 
                name: 'waktu',
                render: function(data, type, row) {
                    return `<span class="block text-sm font-semibold text-gray-900">${data}</span>`;
                }
            },
            { 
                data: 'status',
                name: 'status',
                render: function(data) {
                    let statusClass = 'bg-gray-100 text-gray-800';
                    let statusIcon = '';
                    
                    if (data === 'Berlangsung') {
                        statusClass = 'bg-teal-100 text-teal-800';
                        statusIcon = '<svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" /></svg>';
                    } else if (data === 'Selesai') {
                        statusClass = 'bg-blue-100 text-blue-800';
                        statusIcon = '<svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" /></svg>';
                    } else if (data === 'Tertunda') {
                        statusClass = 'bg-yellow-100 text-yellow-800';
                        statusIcon = '<svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/></svg>';
                    }
                    
                    return `<span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium ${statusClass} rounded-full">
                              ${statusIcon}
                              ${data}
                            </span>`;
                }
            },
            { 
                data: 'nilai_kontrak', 
                name: 'nilai_kontrak',
                render: function(data) {
                    return `<div class="flex items-center gap-x-3">
                              <span class="text-xs text-gray-900">${data}</span>
                            </div>`;
                }
            },
            { 
                data: 'alamat', 
                name: 'alamat',
                render: function(data) {
                    return `<span class="text-sm text-gray-900">${data}</span>`;
                }
            },
            { 
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                responsivePriority: 4,
                render: function(data, type, row) {
                    return `<div class="flex justify-end gap-x-3">
                              <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium" href="/projects/${row.id}/edit">
                                <span class="text-blue-600">Edit</span>
                              </a>
                              <a class="inline-flex items-center gap-x-1 text-sm text-red-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium" href="#" onclick="deleteProject(${row.id}); return false;">
                                <span class="text-red-600">Delete</span>
                              </a>
                            </div>`;
                }
            }
        ],
        language: {
            paginate: {
                previous: "Sebelumnya",
                next: "Selanjutnya"
            },
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ hasil",
            emptyTable: "Tidak ada data yang tersedia",
            zeroRecords: "Tidak ditemukan data yang sesuai",
            infoEmpty: "Menampilkan 0 hingga 0 dari 0 hasil",
            infoFiltered: "(difilter dari _MAX_ total hasil)",
            processing: '<div class="flex justify-center items-center py-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div></div>'
        },
        // Improved responsive settings
        responsive: {
            details: {
                type: 'column',
                target: 0,
                renderer: function(api, rowIdx, columns) {
                    var data = '<table class="w-full text-sm border-collapse bg-gray-50 p-2 rounded">';
                    
                    $.each(columns, function(i, col) {
                        // Skip rendering the control column and visible columns
                        if (col.hidden) {
                            data += '<tr class="border-b border-gray-100">' +
                                '<td class="py-2 px-4 font-semibold" style="width: 30%">' + col.title + ':</td>' +
                                '<td class="py-2 px-4">' + col.data + '</td>' +
                                '</tr>';
                        }
                    });
                    
                    data += '</table>';
                    
                    return data ? 
                        $('<div class="py-2 px-3 bg-gray-50 rounded my-2"/>')
                            .append(data) : false;
                }
            }
        },
        order: [[1, 'asc']] // Order by the second column (index) by default
    });
});
</script>
@endsection
