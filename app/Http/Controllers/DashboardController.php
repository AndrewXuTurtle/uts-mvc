<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Project;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get statistics for dashboard
        $totalDosen = Dosen::count();
        $totalProjects = Project::count();
        $totalMatakuliah = Matakuliah::count();

        // Get recent data
        $recentDosen = Dosen::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();
        $recentMatakuliah = Matakuliah::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalDosen',
            'totalProjects',
            'totalMatakuliah',
            'recentDosen',
            'recentProjects',
            'recentMatakuliah'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
