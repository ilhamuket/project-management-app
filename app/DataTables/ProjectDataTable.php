<?php
// app/DataTables/ProjectDataTable.php

namespace App\DataTables;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProjectDataTable extends DataTable
{
    /**
     * Build DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('checkbox', function ($project) {
                return '<label for="hs-at-with-checkboxes-' . $project->id . '" class="flex">
                    <input type="checkbox" class="hs-at-with-checkboxes-individual shrink-0 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-at-with-checkboxes-' . $project->id . '" value="' . $project->id . '">
                    <span class="sr-only">Checkbox</span>
                </label>';
            })
            ->addColumn('paket_pekerjaan', function ($project) {
                return '<span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">' . e($project->paket_pekerjaan) . '</span>';
            })
            ->addColumn('waktu', function ($project) {
                return '<span class="text-sm text-gray-600 dark:text-neutral-400">' . 
                    $project->tanggal_mulai->format('d M Y') . ' - ' . 
                    $project->tanggal_selesai->format('d M Y') . '</span>';
            })
            ->addColumn('status', function ($project) {
                $statusClass = match($project->status) {
                    'Progress' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/10 dark:text-yellow-500',
                    'Selesai' => 'bg-green-100 text-green-800 dark:bg-green-500/10 dark:text-green-500',
                    default => 'bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-500'
                };
                
                return '<span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium ' . $statusClass . ' rounded-full">' . 
                    e($project->status) . '</span>';
            })
            ->addColumn('nilai_kontrak', function ($project) {
                return '<span class="text-sm text-gray-600 dark:text-neutral-400">Rp ' . 
                    number_format($project->nilai_kontrak, 0, ',', '.') . '</span>';
            })
            ->addColumn('jenis_konstruksi', function ($project) {
                return '<span class="text-sm text-gray-600 dark:text-neutral-400">' . e($project->jenis_konstruksi) . '</span>';
            })
            ->addColumn('action', function ($project) {
                return '
                    <div class="inline-flex gap-x-2">
                        <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500" href="' . route('projects.edit', $project->id) . '">
                            Edit
                        </a>
                        <form action="' . route('projects.destroy', $project->id) . '" method="POST" class="inline" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus paket pekerjaan ini?\')">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="text-sm text-red-600 hover:underline focus:outline-hidden focus:underline dark:text-red-500">
                                Hapus
                            </button>
                        </form>
                    </div>';
            })
            ->rawColumns(['checkbox', 'paket_pekerjaan', 'waktu', 'status', 'nilai_kontrak', 'jenis_konstruksi', 'action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     */
    public function query(Project $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     */
    public function html(): HtmlBuilder
{
    return $this->builder()
        ->setTableId('projects-table')
        ->columns($this->getColumns())
        ->ajax([
            'url' => route('projects.index'),
            'type' => 'GET',
        ])
        ->parameters([
            'processing' => true,
            'serverSide' => true,
            'responsive' => true,
            'pageLength' => 10,
            'language' => [
                'processing' => 'Memproses...',
                'search' => 'Cari:',
                'lengthMenu' => 'Tampilkan _MENU_ data',
                'info' => 'Menampilkan _START_ hingga _END_ dari _TOTAL_ data',
                'infoEmpty' => 'Menampilkan 0 hingga 0 dari 0 data',
                'infoFiltered' => '(disaring dari _MAX_ total data)',
                'paginate' => [
                    'first' => 'Pertama',
                    'last' => 'Terakhir',
                    'next' => 'Selanjutnya',
                    'previous' => 'Sebelumnya'
                ],
                'emptyTable' => 'Tidak ada data tersedia',
                'zeroRecords' => 'Tidak ditemukan data yang sesuai'
            ]
        ]);
}

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('checkbox')
                ->title('<label for="hs-at-with-checkboxes-main" class="flex">
                    <input type="checkbox" class="shrink-0 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-at-with-checkboxes-main">
                    <span class="sr-only">Checkbox</span>
                </label>')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            
            Column::computed('paket_pekerjaan')
                ->title('Paket Pekerjaan'),
            
            Column::computed('waktu')
                ->title('Waktu'),
            
            Column::computed('status')
                ->title('Status'),
            
            Column::computed('nilai_kontrak')
                ->title('Nilai Kontrak'),
            
            Column::computed('jenis_konstruksi')
                ->title('Jenis Konstruksi'),
            
            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'Project_' . date('YmdHis');
    }
}