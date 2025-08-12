<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStats()
    {
        // Count total movies
        $totalMovies = DB::table('movies')->count();
        
        // Count total TV series
        $totalSeries = DB::table('tv_series')->count();
        
        // Count total persons (actors, directors, etc.)
        $totalPersons = DB::table('persons')->count();
        
        // Count total registered users
        $totalUsers = DB::table('users')->count();
        
        // Count total countries
        $totalCountries = DB::table('countries')->count();
        
        // Count recent uploads (ultimi 7 giorni)
        // Usiamo una semplice query SQL con DATE_SUB
        $recentUploads = DB::table('video_files')
            ->whereRaw('created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)')
            ->count();
        
        // Return data in the requested format
        return Response::json([
            'data' => [
                'totalMovies' => $totalMovies,
                'totalSeries' => $totalSeries,
                'totalPersons' => $totalPersons,
                'totalUsers' => $totalUsers,
                'totalCountries' => $totalCountries,
                'recentUploads' => $recentUploads
            ]
        ]);
    }
}
