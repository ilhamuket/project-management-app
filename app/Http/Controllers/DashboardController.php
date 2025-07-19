<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display the dashboard
     */
    public function index(Request $request)
    {
        try {
            $year = $request->get('year', date('Y'));
            
            // Validate year
            if (!is_numeric($year) || $year < 1900 || $year > 2100) {
                $year = date('Y');
            }
            
            // Get dashboard statistics
            $stats = $this->dashboardService->getDashboardStats();
            
            // Get monthly project data with status breakdown
            $monthlyProjectData = $this->dashboardService->getMonthlyProjectData($year);
            
            // Get total projects per month
            $totalProjectsPerMonth = $this->dashboardService->getTotalProjectsPerMonth($year);
            
            // Get top 10 running projects
            $topRunningProjects = $this->dashboardService->getTopRunningProjects();
            
            // Get budget utilization data
            $budgetUtilization = $this->dashboardService->getBudgetUtilization($year);
            
            // Get new projects data
            $newProjectsData = $this->dashboardService->getNewProjectsData();

            // Ensure data is in correct format
            $monthlyProjectData = $monthlyProjectData ?? [];
            $totalProjectsPerMonth = $totalProjectsPerMonth ?? [];
            $topRunningProjects = $topRunningProjects ?? collect([]);

            return view('dashboard', compact(
                'stats',
                'monthlyProjectData',
                'totalProjectsPerMonth',
                'topRunningProjects',
                'budgetUtilization',
                'newProjectsData',
                'year'
            ));
        } catch (\Exception $e) {
            // Log error and return with default data
            \Log::error('Dashboard error: ' . $e->getMessage());
            
            return view('dashboard.index', [
                'stats' => [
                    'total_paket_pekerjaan' => 0,
                    'paket_berlangsung' => 0,
                    'paket_selesai' => 0,
                    'total_nilai_kontrak' => 0,
                    'total_change' => 0,
                    'completed_change' => 0,
                ],
                'monthlyProjectData' => [],
                'totalProjectsPerMonth' => [],
                'topRunningProjects' => collect([]),
                'budgetUtilization' => [],
                'newProjectsData' => [],
                'year' => date('Y')
            ]);
        }
    }

    /**
     * Get chart data via AJAX
     */
    public function getChartData(Request $request)
    {
        $type = $request->get('type');
        $year = $request->get('year', date('Y'));

        switch ($type) {
            case 'monthly_breakdown':
                $data = $this->dashboardService->getMonthlyProjectData($year);
                break;
                
            case 'monthly_total':
                $data = $this->dashboardService->getTotalProjectsPerMonth($year);
                break;
                
            case 'budget_utilization':
                $data = $this->dashboardService->getBudgetUtilization($year);
                break;
                
            case 'new_projects':
                $days = $request->get('days', 12);
                $data = $this->dashboardService->getNewProjectsData($days);
                break;
                
            default:
                $data = [];
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Get running projects data
     */
    public function getRunningProjects()
    {
        $projects = $this->dashboardService->getTopRunningProjects();
        
        return response()->json([
            'success' => true,
            'data' => $projects
        ]);
    }
}