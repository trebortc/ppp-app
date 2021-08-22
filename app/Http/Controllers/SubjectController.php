<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Subject;
use App\Career;
use Illuminate\Http\Request;
use App\Http\Resources\Subject as SubjectResource;
use App\Http\Resources\SubjectCollection;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return SubjectCollection
     */
    public function index()
    {
        return response()->json(new SubjectCollection(Subject::all()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $this->authorize('view', $subject);
        return response()->json(new SubjectResource($subject), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Subject::class);

        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'name' => 'required|string|max:255',
            'code' => 'required|unique:subjects|string|max:255',
            'level' => 'required|integer|min:1|digits_between:1,10',
            'unit' => 'required|string|max:255',
            'field' => 'required|string|max:255',
        ]);

        $subject = new Subject($request->all());
        $subject->status = 'active';
        $subject->save();

        $subject->careers()->sync([$request->get('career_id'),]);

        return response()->json(new SubjectResource($subject), 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $this->authorize('update', $subject);

        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'name' =>'required|string|max:255',
            'code' => 'required|unique:subjects,code,'.$subject->id.'|string|max:255',
            'level' => 'required|integer|min:1|digits_between:1,10',
            'unit' => 'required|string|max:255',
            'field' => 'required|string|max:255',
            'topics' => 'required|array|min:1',
        ]);

        $subject->update($request->all());

        $subject->careers()->sync([$request->get('career_id'),]);

        $topics = [];
        if ($request->get('topics') !== null) {
            foreach ($request->get('topics') as $topic) {
                $topics[] = new Topic(['name' => $topic, 'status' => 'active']);
            }
        }

        $subject->topics()->delete();
        $subject->topics()->saveMany($topics);

        return response()->json(new SubjectResource($subject), 200);
    }

    /**
     * Disabled the specified resource in storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function disable(Subject $subject)
    {
        $this->authorize('disable', $subject);
        $subject->status = 'disabled';
        $subject->save();
        return response()->json(new SubjectResource($subject), 200);
    }
}
