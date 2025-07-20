<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\DataTables\ProjectDataTable;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
        \Log::info('ProjectController initialized');
    }

    public function index(Request $request)
    {
        return view('projects.index');
    }

    public function getData(ProjectDataTable $dataTable)
    {
        return $dataTable->ajax();
    }

    public function create()
    {
        \Log::info('Accessing project create form');
        return view('projects.create');
    }

    public function store(Request $request)
    {
       
        \Log::info('Attempt to store new project', ['data' => $request->except(['foto', 'dokumen_kontrak'])]);
        
        $validator = Validator::make($request->all(), [
            'paket_pekerjaan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alamat' => 'required|string',
            'koordinat' => [
                'nullable',
                'string',
                'regex:/^-?\d{1,3}(\.\d+)?,\s*-?\d{1,3}(\.\d+)?$/',
            ],
            'foto' => 'nullable|image|max:2048',
            'jenis_konstruksi' => 'required|string|in:Cor Beton,Drainase,Pengerasan,Lainnya',
            'panjang' => 'nullable|numeric|min:0',
            'lebar' => 'nullable|numeric|min:0',
            'tebal' => 'nullable|numeric|min:0',
            'nilai_kontrak' => 'required|numeric|min:0',
            'nama_kontraktor' => 'required|string|max:255',
            'nama_konsultan_perencana' => 'nullable|string|max:255',
            'nama_konsultan_pengawas' => 'nullable|string|max:255',
            'dokumen_kontrak.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'tipe_anggaran' => 'required|in:APBD,APBDP',
            'status' => 'required|in:Belum dimulai,Progress,Selesai',
        ]);

        if ($validator->fails()) {
            \Log::warning('Project creation validation failed', ['errors' => $validator->errors()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $project = $this->projectService->create($request->all());
            \Log::info('Project created successfully', ['project_id' => $project->id]);
            return redirect()->route('projects.index')->with('success', 'Paket pekerjaan berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error('Error creating project', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Gagal menambahkan paket pekerjaan. Silakan coba lagi.')->withInput();
        }
    }

    public function edit(Project $project)
    {
        \Log::info('Accessing project edit form', ['project_id' => $project->id]);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        \Log::info('Attempt to update project', ['project_id' => $project->id, 'data' => $request->except(['foto', 'dokumen_kontrak'])]);
        
        $validator = Validator::make($request->all(), [
            'paket_pekerjaan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alamat' => 'required|string',
            'koordinat' => [
                'nullable',
                'string',
                'regex:/^-?\d{1,3}(\.\d+)?,\s*-?\d{1,3}(\.\d+)?$/',
            ],
            'foto' => 'nullable|image|max:2048',
            'jenis_konstruksi' => 'required|string|in:Cor Beton,Drainase,Pengerasan,Lainnya',
            'panjang' => 'nullable|numeric|min:0',
            'lebar' => 'nullable|numeric|min:0',
            'tebal' => 'nullable|numeric|min:0',
            'nilai_kontrak' => 'required|numeric|min:0',
            'nama_kontraktor' => 'required|string|max:255',
            'nama_konsultan_perencana' => 'nullable|string|max:255',
            'nama_konsultan_pengawas' => 'nullable|string|max:255',
            'dokumen_kontrak.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'tipe_anggaran' => 'required|in:APBD,APBDP',
            'status' => 'required|in:Belum dimulai,Progress,Selesai',
        ]);

        if ($validator->fails()) {
            \Log::warning('Project update validation failed', ['project_id' => $project->id, 'errors' => $validator->errors()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $this->projectService->update($project, $request->all());
            \Log::info('Project updated successfully', ['project_id' => $project->id]);
            return redirect()->route('projects.index')->with('success', 'Paket pekerjaan berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error('Error updating project', ['project_id' => $project->id, 'message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Gagal memperbarui paket pekerjaan. Silakan coba lagi.')->withInput();
        }
    }

    public function show(Project $project)
    {
        \Log::info('Accessing project details', ['project_id' => $project->id]);
        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        \Log::info('Attempt to delete project', ['project_id' => $project->id]);
        
        try {
            $this->projectService->delete($project);
            \Log::info('Project deleted successfully', ['project_id' => $project->id]);
            return redirect()->route('projects.index')->with('success', 'Paket pekerjaan berhasil dihapus.');
        } catch (\Exception $e) {
            \Log::error('Error deleting project', ['project_id' => $project->id, 'message' => $e->getMessage()]);
            return redirect()->route('projects.index')->with('error', 'Gagal menghapus paket pekerjaan. Silakan coba lagi.');
        }
    }
}