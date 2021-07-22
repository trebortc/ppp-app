<?php

namespace App\Http\Controllers;

use App\Career;
use App\Http\Resources\Career as CareerResource;
use App\Http\Resources\CareerCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(new CareerCollection(Career::all()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Career  $career
     * @return JsonResponse
     */
    public function show(Career $career)
    {
        $this->authorize('view', $career);
        return response()->json(new CareerResource($career), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Career::class);

        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' =>'required|unique:careers|string|max:255',
            'pensum' => 'required|string|max:255',
            'levels' => 'required|integer|min:1|digits_between:1,10',
        ]);

        $career = new Career($request->all());
        $career->status = 'active';
        $career->save();

        return response()->json(new CareerResource($career), 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Career  $career
     * @return JsonResponse
     */
    public function update(Request $request, Career $career)
    {
        $this->authorize('update', $career);

        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|unique:careers,name,'.$career->id.'|string|max:255',
            'pensum' => 'required|string|max:255',
            'levels' => 'required|integer|min:1|digits_between:1,10',
        ]);

        $career->update($request->all());

        return response()->json(new CareerResource($career), 200);
    }

    /**
     * Disabled the specified resource in storage.
     *
     * @param  \App\Career  $career
     * @return JsonResponse
     */
    public function disable(Career $career)
    {
        $this->authorize('disable', $career);
        $career->status = 'disabled';
        $career->save();
        return response()->json(new CareerResource($career), 200);
    }
}
