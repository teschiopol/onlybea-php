<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Gate;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Applications/Index', [
            'applications' => Application::with('user:id,name')->latest()->get(),
            'companies' => Company::all()->sortDesc(),
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
    public function store(Request $request): RedirectResponse
    {
        
        $validated = $request->validate([
            'company_id' => 'required|integer',
            'status' => 'required|integer',
            'type' => 'required|integer',
            'notes' => 'nullable|string|max:255',
            'role' => 'required|string|max:255'
        ]);

        if (empty($validated['notes'])) {
            $validated['notes'] = '';
        }
            
        $request->user()->applications()->create($validated);
     
        return redirect(route('applications.index'));
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
    public function update(Request $request, Application $requestModel): RedirectResponse
    {
        // Gate::authorize('update', $requestModel);

        $validated = $request->validate([
            'id' => 'required|integer',
            'company_id' => 'required|integer',
            'status' => 'required|integer',
            'type' => 'required|integer',
            'notes' => 'nullable|string|max:255',
            'role' => 'required|string|max:255'
        ]);
     
        $req = Application::find($validated['id']);

        if (empty($validated['notes'])) {
            $validated['notes'] = '';
        }
            
        $req->company_id = $validated['company_id'];
        $req->status = $validated['status'];
        $req->type = $validated['type'];
        $req->notes = $validated['notes'];
        $req->role = $validated['role'];

        $req->save();
            
        return redirect(route('applications.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $request)
    {
        //
    }
}
