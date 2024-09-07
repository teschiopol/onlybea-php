<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'total' => Application::with('user:id,name')->count(),
            'sent' => Application::with('user:id,name')->where('status', '=', 0)->count(),
            'ignored' => Application::with('user:id,name')->where('status', '=', 1)->count(),
            'reject' => Application::with('user:id,name')->where('status', '=', 2)->count(),
            'tech' => Application::with('user:id,name')->where('status', '=', 3)->count(),
            'offer' => Application::with('user:id,name')->where('status', '=', 4)->count(),
            'remote' => Application::with('user:id,name')->where('type', '=', 0)->count(),
            'hybrid' => Application::with('user:id,name')->where('type', '=', 1)->count(),
            'office' => Application::with('user:id,name')->where('type', '=', 2)->count()
        ]);
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

    }

    /**
     * Display the specified resource.
     */
    public function show(Application $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $requestModel)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $request)
    {
        //
    }
}
