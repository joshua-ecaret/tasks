<?php

namespace App\Http\Controllers;

use App\Http\Requests\Package\UpdatePackageRequest;
use App\Http\Requests\StorePackageRequest;
use App\Http\Resources\Package\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::all();
        return PackageResource::collection($packages);
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
    public function show(string $id)
    {
        $package = Package::findOrFail($id);
        return new PackageResource($package);
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
    public function update(UpdatePackageRequest $request, string $id)
    {
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
        return new Response(["message"=>"Deleted Successfully"], 204);
    }
}
