<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\TvSerie;
use App\Models\Person;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
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
        // Count total movies (respects soft delete)
        $totalMovies = Movie::count();
        
        // Count total TV series (respects soft delete)
        $totalSeries = TvSerie::count();
        
        // Count total persons (actors, directors, etc.) (respects soft delete)
        $totalPersons = Person::count();
        
        // Count total registered users (respects soft delete)
        $totalUsers = User::count();
        
        // Count total countries (no soft delete on countries)
        $totalCountries = Country::count();
        
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
