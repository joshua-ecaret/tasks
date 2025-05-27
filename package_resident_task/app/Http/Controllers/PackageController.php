<?php

namespace App\Http\Controllers;

use App\DataTables\PackagesDataTable;
use App\Http\Requests\Package\StorePackageRequest;
use App\Http\Requests\Package\UpdatePackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PackagesDataTable $dataTable)
    {
        return $dataTable->render('packages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('packages.create', ['package' => new Package()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->validated());
        return response()->json([
            'message' => 'Package created successfully',
            'package' => $package
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, string $id)
    {

        dd($request->all());
        $package = Package::findOrFail($id);
        $package->update($request->validated());
        return response()->json([
            'message' => 'Package updated successfully',
            'package' => $package
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Deleted successfully');

        

    }
}
