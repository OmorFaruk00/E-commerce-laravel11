<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantRequest;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tenant::get();
        return view('admin.tenant.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tenant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantRequest $request)
    {
        $validatedData = $request->validated();
        
       $tenant =  Tenant::create($validatedData);
       $tenant->domains()->create([
        'domain' => $validatedData['domain_name'] .'.'.config('app.domain'), 
    ]);

        return redirect()->route('tenant.index')->with('success', 'Tenant Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenent)
    {
        return 'tenant';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenent)
    {
        //
    }
    public function test()
    {
        return 'test';
    }   
}
