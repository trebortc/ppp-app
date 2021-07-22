<?php

namespace App\Http\Controllers;

use App\Followup;
use App\Http\Resources\FollowupCollection;
use App\Http\Resources\Followup as FollowupResource;
use App\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Internship $internship
     * @return FollowupCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Internship $internship)
    {
        $this->authorize('viewAny', [Followup::class, $internship]);
        return new FollowupCollection($internship->followups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Internship $internship
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Internship $internship)
    {
        $this->authorize('create', [Followup::class, $internship]);
        $request->validate([
            'text' => 'required|string',
            'type' => 'required|in:followup,compliment,complaint',
        ]);
        $followup = new Followup($request->all());
        $followup->user_id = Auth::id();
        $followup->user_type = strtolower(explode('_', Auth::user()->role)[1]);

        $internship->followups()->save($followup);

        return response()->json(new FollowupResource($followup), 201);
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Followup  $followup
//     * @return \Illuminate\Http\Response
//     */
//    public function show(Followup $followup)
//    {
//        //
//    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Followup  $followup
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Followup $followup)
//    {
//        //
//    }

//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Followup  $followup
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Followup $followup)
//    {
//        //
//    }
}
