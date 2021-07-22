<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\StoreCompany;
use App\Http\Requests\UpdateCompany;
use App\Http\Resources\CompanyCollection;
use Illuminate\Http\Request;
use App\Http\Resources\Company as CompanyResource;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CompanyCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Company::class);
        return new CompanyCollection(Company::orderByDesc('created_at')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Company $company
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Company $company)
    {
        $this->authorize('view', $company);
        return response()->json(new CompanyResource($company), 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Company::class);
        $request->validate([
            'ruc' => 'required|string|max:255|unique:companies',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:companies',
            'phone' => 'required|min:7',
            'mobile' => 'min:7',
            'type' => 'required|in:pública,privada,organismo internacional,tercer sector,otras',
        ]);
        $company = Company::create($request->all());

        return response()->json(new CompanyResource($company), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Company $company
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);
        $request->validate([
            'ruc' => 'required|string|max:255|unique:companies,ruc,' . $this->route('company')->ruc,
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:companies,email,' . $this->route('company')->email,
            'phone' => 'required|min:7',
            'mobile' => 'min:7',
            'type' => 'required|in:pública,privada,organismo internacional,tercer sector,otras',
        ]);
        $company->update($request->all());

        return response()->json(new CompanyResource($company), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $ruc
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function byRUC($ruc)
    {
        $this->authorize('byRUC', Company::class);
        $company = Company::where('ruc', $ruc)->firstOrFail();
        return response()->json(new CompanyResource($company), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
