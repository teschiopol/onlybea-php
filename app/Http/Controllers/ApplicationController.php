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
            'item_id' => 'exclude_if:type,1|required|integer',
            'item' => 'exclude_if:type,0|required|string|max:255',
            'status' => 'integer',
            'type' => 'integer',
            'qta' => 'required|integer|min:1',
        ]);
            
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
 

     
            Gate::authorize('update', $requestModel);

            $validated = $request->validate([
                'status' => 'required|integer',
                'id' => 'required'
            ]);
     
            $req = Application::find($validated['id']);
            
            $req->status = $validated['status'];

            if ($req->save()) {
                // check status
                if ((int)$req->status === 1 && (int)$req->type === 0) {
                    // prenderci item
                    $item = Company::find($req->item_id);
                    // togliere
                    if ($item) {
                        $item->availability -= $req->qta;
                        // salvare
                        $item->save();
                    }
                    
                }
            }
            
     
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