<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectService
{
    public function create(array $data)
    {
        // Handle file uploads
        if (isset($data['foto'])) {
            $data['foto'] = $this->uploadFile($data['foto'], 'photos');
        }

        if (isset($data['dokumen_kontrak'])) {
            $dokumenPaths = [];
            foreach ($data['dokumen_kontrak'] as $dokumen) {
                $dokumenPaths[] = $this->uploadFile($dokumen, 'documents');
            }
            $data['dokumen_kontrak'] = json_encode($dokumenPaths);
        }

        return Project::create($data);
    }

    public function update(Project $project, array $data)
    {
        // Handle file uploads
        if (isset($data['foto'])) {
            // Delete old photo if exists
            if ($project->foto) {
                Storage::disk('public')->delete($project->foto);
            }
            $data['foto'] = $this->uploadFile($data['foto'], 'photos');
        }

        if (isset($data['dokumen_kontrak'])) {
            // Delete old documents if exists
            if ($project->dokumen_kontrak) {
                foreach (json_decode($project->dokumen_kontrak, true) as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
            $dokumenPaths = [];
            foreach ($data['dokumen_kontrak'] as $dokumen) {
                $dokumenPaths[] = $this->uploadFile($dokumen, 'documents');
            }
            $data['dokumen_kontrak'] = json_encode($dokumenPaths);
        }

        return $project->update($data);
    }

    public function delete(Project $project)
    {
        // Delete associated files
        if ($project->foto) {
            Storage::disk('public')->delete($project->foto);
        }
        if ($project->dokumen_kontrak) {
            foreach (json_decode($project->dokumen_kontrak, true) as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        return $project->delete();
    }

    protected function uploadFile($file, $directory)
    {
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($directory, $filename, 'public');
    }
}