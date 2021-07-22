<?php

namespace App\Http\Controllers;

//use App\Http\Resources\Career;
use App\Career;
use App\Http\Resources\TopicCollection;
use App\Http\Resources\Topic as TopicResource;
use App\Subject;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Subject $subject
     * @return TopicCollection
     */
    public function index(Subject $subject)
    {
        return new TopicCollection($subject->topics);
        //return response()->json(new TopicCollection($subject->topics),200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function all()
    {
        return response()->json(new TopicCollection(Topic::all()),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return JsonResponse
     */
    public function show(Topic $topic)
    {
        $this->authorize('view', $topic);
        return response()->json(new TopicResource($topic), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Topic::class);

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'name' =>'required|string|max:255',
        ]);

        $topic = new Topic($request->all());
        $topic->status = 'active';
        $topic->save();

        return response()->json(new TopicResource($topic), 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return JsonResponse
     */
    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'name' =>'required|string|max:255',
        ]);

        $topic->update($request->all());

        return response()->json(new TopicResource($topic), 200);
    }

    /**
     * Disabled the specified resource in storage.
     *
     * @param  \App\topic  $topic
     * @return JsonResponse
     */
    public function disable(Topic $topic)
    {
        $this->authorize('disable', $topic);
        $topic->status = 'disabled';
        $topic->save();
        return response()->json(new TopicResource($topic), 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Career $career
     * @return JsonResponse
     */
    public function getCareerSubjectsTopics(Career $career)
    {
        $subjects = $career->subjects;
        //dd($subjects);
        $topicsBySubject = [];
        foreach ($subjects as $subject) {
            $topicsBySubject[] = [
                'id' => $subject->id,
                'name' => $subject->name,
                'topics' => $subject->topics
            ];
        }
        return response()->json($topicsBySubject, 200);
    }
}
