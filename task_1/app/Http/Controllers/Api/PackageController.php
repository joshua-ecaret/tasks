<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\StorePackageRequest;
use App\Http\Requests\Package\UpdatePackageRequest;
use App\Http\Resources\Package\PackageResource;
use App\Models\Package;
use Symfony\Component\HttpFoundation\Response;


class PackageController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        return PackageResource::collection(Package::all());
    }

    // Store a newly created resource in storage.
    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->validated());

        return new PackageResource($package);
    }

    // Display the specified resource.
    public function show(Package $package)
    {
        return new PackageResource($package);
    }

    // Update an existing package
    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->validated());

        return new PackageResource($package);
    }

    // Delete a package
    public function destroy(Package $package)
    {
        $package->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
