<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\StorePackageRequest;
use App\Http\Requests\Package\UpdatePackageRequest;
use App\Http\Resources\Package\PackageResource;
use App\Models\Package;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return PackageResource::collection(Package::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request): PackageResource
    {
        $package = Package::create($request->validated());

        return new PackageResource($package);
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package): PackageResource
    {
        return new PackageResource($package);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, Package $package): PackageResource
    {
        $package->update($request->validated());

        return new PackageResource($package);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package): HttpResponse
    {
        $package->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
