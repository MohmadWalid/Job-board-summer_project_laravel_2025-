<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = JobVacancy::query();

        // Search (title, location, company name)
        if ($request->filled('search')) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('company', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Job type filter
        if ($request->has('filter')) {
            $query->where('type', $request->filter);
        }


        /// Get results from DB
        $jobs = $query->with('company')->latest()->paginate(9);

        return view('dashboard', compact('jobs'));
    }
}
