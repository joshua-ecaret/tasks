<?php

namespace App\Http\Controllers;

use App\DataTables\ResidentsDataTable;
use App\Http\Requests\Resident\StoreResidentRequest;
use App\Http\Requests\Resident\UpdateResidentRequest;
use App\Models\Package;
use App\Models\Resident;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ResidentsDataTable $dataTable)
    {
        return $dataTable->render('residents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::active()->pluck('package_name', 'id')->toArray();
        return view('residents.create', ['resident' => new Resident(), 'packages' => $packages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResidentRequest $request)
    {
        $resident = Resident::create($request->validated());
        return response()->json([
            'message' => 'Resident created successfully',
            'resident' => $resident
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Resident $resident)
    {
        return view('residents.show', compact('resident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resident $resident)
    {
        return view('residents.edit', compact('resident'));    //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResidentRequest $request, string $id)
    {

        $resident = Resident::findOrFail($id);
        $resident->update($request->validated());
        return response()->json([
            'message' => 'Resident updated successfully',
            'resident' => $resident
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resident $resident)
    {
        $resident->delete();
        return redirect()->route('residents.index')->with('success', 'Resident deleted successfully');
    }



    public function toggleStatus(Resident $resident)
    {
        $resident->toggleStatus();
        return redirect()->back()->with('success', 'Resident status toggled.');
    }
}
