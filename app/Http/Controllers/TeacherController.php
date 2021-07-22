<?php

namespace App\Http\Controllers;

use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\TeacherCollection;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TeacherCollection
     */
    public function index()
    {
        return response()->json(new TeacherCollection(Teacher::all()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $this->authorize('view', $teacher);
        return response()->json(new TeacherResource($teacher), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Teacher::class);

        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'degree' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|min:7',
            'mobile' => 'min:7',
            'sex' => 'required|in:male,female',
        ]);

        $plain_password = Str::random(8);

        $teacher = new Teacher($request->all());
        $teacher->save();

        $teacher->user()->create([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'mobile' => $request->get('mobile'),
            'sex' => $request->get('sex'),
            'password' => Hash::make($plain_password),
            'status' => 'active',
        ]);


        return response()->json(new TeacherResource($teacher), 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $this->authorize('update', $teacher);

        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'degree' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|unique:users,email,'. $teacher->user->id.'|string|max:255',
            'phone' => 'required|min:7',
            'mobile' => 'min:7',
            'sex' => 'required|in:male,female',
        ]);

        $plain_password = Str::random(8);
        $teacher->update($request->all());

        $teacher->user()->update([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'mobile' => $request->get('mobile'),
            'sex' => $request->get('sex'),
        ]);

        return response()->json(new TeacherResource($teacher), 200);
    }

    /**
     * Disabled the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function disable(Teacher $teacher)
    {
        $this->authorize('disable', $teacher);
        $teacher->user()->update([
            'status' => 'disabled'
        ]);
        return response()->json(new TeacherResource($teacher), 200);
    }
}
