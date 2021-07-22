<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\Http\Resources\Administrative as AdministrativeResource;
use App\Http\Resources\AdministrativeCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdministrativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(new AdministrativeCollection(Administrative::all()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Administrative  $administrative
     * @return JsonResponse
     */
    public function show(Administrative $administrative)
    {
        $this->authorize('view', $administrative);
        return response()->json(new AdministrativeResource($administrative), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Administrative::class);

        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|min:7',
            'mobile' => 'min:7',
            'sex' => 'required|in:male,female',
        ]);

        $plain_password = Str::random(8);

        $administrative = new Administrative($request->all());
        $administrative->save();

        $administrative->user()->create([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'mobile' => $request->get('mobile'),
            'sex' => $request->get('sex'),
            'password' => Hash::make($plain_password),
            'status' => 'active',
        ]);


        return response()->json(new AdministrativeResource($administrative), 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrative  $administrative
     * @return JsonResponse
     */
    public function update(Request $request, Administrative $administrative)
    {
        $this->authorize('update', $administrative);
        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|unique:users,email,'. $administrative->user->id.'|string|max:255',
            'phone' => 'required|min:7',
            'mobile' => 'min:7',
            'sex' => 'required|in:male,female',
        ]);

        $plain_password = Str::random(8);
        $administrative->update($request->all());

        $administrative->user()->update([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'mobile' => $request->get('mobile'),
            'sex' => $request->get('sex'),
        ]);

        return response()->json(new AdministrativeResource($administrative), 200);
    }

    /**
     * Disabled the specified resource in storage.
     *
     * @return JsonResponse
     */
    public function disable(Administrative $administrative)
    {
        $this->authorize('disable', $administrative);
        $administrative->user()->update([
            'status' => 'disabled'
        ]);
        return response()->json(new AdministrativeResource($administrative), 200);
    }
}
