<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\StoreRepresentative;
use App\Http\Requests\UpdateCompany;
use App\Http\Resources\RepresentativeCollection;
use App\Representative;
use Illuminate\Http\Request;
use App\Http\Resources\Representative as RepresentativeResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RepresentativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Company $company
     * @return RepresentativeCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Company $company)
    {
        $this->authorize('viewAny', [Representative::class, $company]);
        return new RepresentativeCollection($company->representatives()->orderByDesc('created_at')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @param \App\Representative $representative
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Company $company, Representative $representative)
    {
        $this->authorize('view', [$company, $representative]);
        $representative = $company->representatives()->findOrFail($representative);

        return response()->json(new RepresentativeResource($representative), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Company $company)
    {
        $this->authorize('create', [Representative::class, $company]);
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|min:7',
            'mobile' => 'min:7',
            'sex' => 'required|in:male,female',
        ]);
        $representative = $company->representatives()->save(new Representative($request->all()));

        $plain_password = Str::random(8);
        $representative->user()->create([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'mobile' => $request->get('mobile'),
            'sex' => $request->get('sex'),
            'password' => Hash::make($plain_password),
            'status' => 'active', // todo maybe inactive until it changes password for the first time?
            ]);

        // todo send email to representative with data and plain password

        return response()->json(new RepresentativeResource($representative), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @param \App\Representative $representative
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Company $company, Representative $representative)
    {
        $this->authorize('update', [$company, $representative]);
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('representative')->email,
            'phone' => 'required|min:7',
            'mobile' => 'min:7',
            'sex' => 'required|in:masculino,femenino',
        ]);
        $representative->update($request->all());
        return response()->json(new RepresentativeResource($representative), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Representative  $representative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Representative $representative)
    {
        //
    }
}
