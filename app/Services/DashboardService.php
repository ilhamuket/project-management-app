<?php

namespace App\Services;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    /**
     * Get dashboard statistics
     */
    public function getDashboardStats()
    {
        $totalPaketPekerjaan = Project::count();
        $paketBerlangsung = Project::where('status', 'progress')->count();
        $paketSelesai = Project::where('status', 'selesai')->count();
        $totalNilaiKontrak = Project::sum('nilai_kontrak');

        // Calculate percentage changes (comparing with previous period)
        $previousMonthTotal = Project::whereMonth('created_at', Carbon::now()->subMonth()->month)
                                   ->whereYear('created_at', Carbon::now()->subMonth()->year)
                                   ->count();
        
        $currentMonthTotal = Project::whereMonth('created_at', Carbon::now()->month)
                                  ->whereYear('created_at', Carbon::now()->year)
                                  ->count();

        $totalChange = $previousMonthTotal > 0 
            ? round((($currentMonthTotal - $previousMonthTotal) / $previousMonthTotal) * 100, 1)
            : 0;

        $previousMonthCompleted = Project::where('status', 'selesai')
                                        ->whereMonth('updated_at', Carbon::now()->subMonth()->month)
                                        ->whereYear('updated_at', Carbon::now()->subMonth()->year)
                                        ->count();
        
        $currentMonthCompleted = Project::where('status', 'selesai')
                                       ->whereMonth('updated_at', Carbon::now()->month)
                                       ->whereYear('updated_at', Carbon::now()->year)
                                       ->count();

        $completedChange = $previousMonthCompleted > 0 
            ? round((($currentMonthCompleted - $previousMonthCompleted) / $previousMonthCompleted) * 100, 1)
            : 0;

        return [
            'total_paket_pekerjaan' => $totalPaketPekerjaan,
            'paket_berlangsung' => $paketBerlangsung,
            'paket_selesai' => $paketSelesai,
            'total_nilai_kontrak' => $totalNilaiKontrak,
            'total_change' => $totalChange,
            'completed_change' => $completedChange,
        ];
    }

    /**
     * Get monthly project data with status breakdown
     */
    public function getMonthlyProjectData($year = null)
    {
        $year = $year ?? Carbon::now()->year;
        
        $monthlyData = [];
        
        for ($month = 1; $month <= 12; $month++) {
            $belumDimulai = Project::where('status', 'belum_dimulai')
                                 ->whereMonth('created_at', $month)
                                 ->whereYear('created_at', $year)
                                 ->count();
            
            $progress = Project::where('status', 'progress')
                              ->whereMonth('tanggal_mulai', '<=', Carbon::create($year, $month)->endOfMonth())
                              ->whereMonth('tanggal_selesai', '>=', Carbon::create($year, $month)->startOfMonth())
                              ->whereYear('created_at', '<=', $year)
                              ->count();
            
            $selesai = Project::where('status', 'selesai')
                             ->whereMonth('tanggal_selesai', $month)
                             ->whereYear('tanggal_selesai', $year)
                             ->count();
            
            try {
                $monthName = Carbon::create()->month($month)->locale('id')->monthName;
            } catch (\Exception $e) {
                $monthName = Carbon::create()->month($month)->format('F'); // Fallback to English
            }
            
            $monthlyData[] = [
                'month' => $month,
                'month_name' => $monthName,
                'belum_dimulai' => (int) $belumDimulai,
                'progress' => (int) $progress,
                'selesai' => (int) $selesai,
            ];
        }
        
        return $monthlyData;
    }

    /**
     * Get total projects per month
     */
    public function getTotalProjectsPerMonth($year = null)
    {
        $year = $year ?? Carbon::now()->year;
        
        $monthlyTotals = [];
        
        for ($month = 1; $month <= 12; $month++) {
            $total = Project::whereMonth('created_at', $month)
                           ->whereYear('created_at', $year)
                           ->count();
            
            try {
                $monthName = Carbon::create()->month($month)->locale('id')->monthName;
            } catch (\Exception $e) {
                $monthName = Carbon::create()->month($month)->format('F'); // Fallback to English
            }
            
            $monthlyTotals[] = [
                'month' => $month,
                'month_name' => $monthName,
                'total' => (int) $total,
            ];
        }
        
        return $monthlyTotals;
    }

    /**
     * Get top 10 running projects
     */
    public function getTopRunningProjects()
    {
        return Project::where('status', 'progress')
                     ->orderBy('nilai_kontrak', 'desc')
                     ->limit(10)
                     ->select([
                         'id',
                         'paket_pekerjaan',
                         'nilai_kontrak',
                         'tanggal_mulai',
                         'tanggal_selesai',
                         'nama_kontraktor',
                         'alamat'
                     ])
                     ->get()
                     ->map(function ($project) {
                         $project->progress_percentage = $this->calculateProgress($project);
                         $project->nilai_kontrak_formatted = $this->formatCurrency($project->nilai_kontrak);
                         return $project;
                     });
    }

    /**
     * Calculate project progress percentage
     */
    private function calculateProgress($project)
    {
        if (!$project->tanggal_mulai || !$project->tanggal_selesai) {
            return 0;
        }

        $startDate = Carbon::parse($project->tanggal_mulai);
        $endDate = Carbon::parse($project->tanggal_selesai);
        $currentDate = Carbon::now();

        if ($currentDate < $startDate) {
            return 0;
        }

        if ($currentDate > $endDate) {
            return 100;
        }

        $totalDays = $startDate->diffInDays($endDate);
        $passedDays = $startDate->diffInDays($currentDate);

        return round(($passedDays / $totalDays) * 100, 1);
    }

    /**
     * Format currency to readable format
     */
    private function formatCurrency($amount)
    {
        if ($amount >= 1000000000) {
            return 'Rp ' . number_format($amount / 1000000000, 1) . 'M';
        } elseif ($amount >= 1000000) {
            return 'Rp ' . number_format($amount / 1000000, 1) . 'Jt';
        } else {
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }
    }

    /**
     * Get budget utilization data
     */
    public function getBudgetUtilization($year = null)
    {
        $year = $year ?? Carbon::now()->year;
        
        $monthlyBudget = [];
        
        for ($month = 1; $month <= 12; $month++) {
            $currentPeriod = Project::whereMonth('created_at', $month)
                                  ->whereYear('created_at', $year)
                                  ->sum('nilai_kontrak');
            
            $previousPeriod = Project::whereMonth('created_at', $month)
                                   ->whereYear('created_at', $year - 1)
                                   ->sum('nilai_kontrak');
            
            $monthlyBudget[] = [
                'month' => Carbon::create()->month($month)->locale('id')->monthName,
                'current' => $currentPeriod / 1000000, // Convert to millions
                'previous' => $previousPeriod / 1000000, // Convert to millions
            ];
        }
        
        return $monthlyBudget;
    }

    /**
     * Get new projects data for area chart
     */
    public function getNewProjectsData($days = 12)
    {
        $data = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = Project::whereDate('created_at', $date->toDateString())->count();
            
            $data[] = [
                'date' => $date->locale('id')->format('j M Y'),
                'count' => $count,
            ];
        }
        
        return $data;
    }
}