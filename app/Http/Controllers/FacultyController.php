<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Http\Resources\Faculty as FacultyResource;
use App\Http\Resources\FacultyCollection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(new FacultyCollection(Faculty::all()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return JsonResponse
     */
    public function show(Faculty $faculty)
    {
        $this->authorize('view', $faculty);
        return response()->json(new FacultyResource($faculty), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Faculty::class);

        $request->validate([
            'name' =>'required|unique:faculties|string|max:255',
        ]);

        $faculty = new Faculty($request->all());
        $faculty->status = 'active';
        $faculty->save();

        return response()->json(new FacultyResource($faculty), 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculty  $faculty
     * @return JsonResponse
     */
    public function update(Request $request, Faculty $faculty)
    {
        $this->authorize('update', $faculty);

        $request->validate([
            'name' =>'required|unique:faculties,name,'.$faculty->id.'|string|max:255',
        ]);

        $faculty->update($request->all());

        return response()->json(new FacultyResource($faculty), 200);
    }

    /**
     * Disable the specified resource from storage.
     *
     * @param  \App\Faculty  $faculty
     * @return JsonResponse
     */
    public function disable(Faculty $faculty)
    {
        $this->authorize('disable', $faculty);
        $faculty->status = 'disabled';
        $faculty->save();
        return response()->json(new FacultyResource($faculty), 200);
    }
}
