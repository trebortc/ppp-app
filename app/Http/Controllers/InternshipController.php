<?php

namespace App\Http\Controllers;

use App\Http\Resources\InternshipCollection;
use App\Internship;
use App\InternshipActivity;
use App\Mail\NotifyCommissionCreateInternshipProcessMail;
use App\Mail\NotifyCommissionSetStudentSectionMail;
use App\Mail\NotifyCommissionTeacherAssignmentMail;
use App\Mail\NotifyCommissionUpdateInternshipProcessMail;
use App\Mail\NotifyRepresentativeCreateInternshipProcessMail;
use App\Mail\NotifyRepresentativeSetStudentSectionMail;
use App\Mail\NotifyRepresentativeTeacherAssignmentMail;
use App\Mail\NotifyRepresentativeUpdateInternshipProcessMail;
use App\Mail\NotifyStudentCreateInternshipProcessMail;
use App\Mail\NotifyStudentSetStudentSectionMail;
use App\Mail\NotifyStudentTeacherAssignmentMail;
use App\Mail\NotifyStudentUpdateInternshipProcessMail;
use App\Mail\NotifyTeacherSetStudentSectionMail;
use App\Mail\NotifyTeacherTeacherAssignmentMail;
use App\RecommendedTopic;
use App\Topic;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Internship as InternshipResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InternshipController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return InternshipCollection
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Internship::class);
        $user = Auth::user();
        if ($user->role === User::ROLE_ADMINISTRATIVE || $user->role === User::ROLE_COMMISSION) {
            return new InternshipCollection(Internship::orderByDesc('created_at')->paginate(10));
        }
        return new InternshipCollection($user->userable->internships()->orderByDesc('created_at')->paginate(10));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Internship $internship
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Internship $internship)
    {
        $this->authorize('view', $internship);
        return response()->json(new InternshipResource($internship), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Internship::class);
        $request->validate([
            'representative_id' => 'required|exists:representatives,id',
            'start_date' => 'required|date',
            'type' => 'required|in:laboral,servicio a la comunidad',
            'wide_field' => 'required|string|max:255',
            'specific_field' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'student_activities' => 'required|string|min:40',
            'institutional_agreement_code' => 'nullable|string|required_with:institutional_agreement_name',
            'institutional_agreement_name' => 'nullable|string|required_with:institutional_agreement_code',
            'research_project_code' => 'nullable|string|required_with:research_project_name',
            'research_project_name' => 'nullable|string|required_with:research_project_code',
            'social_project_code' => 'nullable|string|required_with:social_project_code',
            'social_project_name' => 'nullable|string|required_with:social_project_code',
        ]);

        $internship = new Internship($request->only([
            'representative_id',
            'start_date',
            'type',
            'wide_field',
            'specific_field',
            'area',
            'student_activities',
            'institutional_agreement_code',
            'institutional_agreement_name',
            'research_project_code',
            'research_project_name',
            'social_project_code',
            'social_project_name',
        ]));

        $internship->status = 'pending';
        $internship->student_id = Auth::user()->userable->id;
        $internship->save();

        //Upload information
        $informacion = [
            'usuario' => Auth::user(),
            'datosSolicitud' => $internship,
            'representante' => $internship->representative->user,
            'compania' => $internship->representative->company,
            'url' => 'https://www.epn.edu.ec/',
        ];

        // Send email to student
        Mail::to([Auth::user()->email,])
            ->send(new NotifyStudentCreateInternshipProcessMail($informacion));

        // Send mail to representative
        Mail::to([$internship->representative->user->email])
          ->send(new NotifyRepresentativeCreateInternshipProcessMail($informacion));

        // Send mail to commissio
        Mail::to([config('app.mail_commission'),])
            ->send(new NotifyCommissionCreateInternshipProcessMail($informacion));

        return response()->json(new InternshipResource($internship), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request)
    {
        $this->authorize('update', Internship::class);
        $request->validate([
            'representative_id' => 'required|exists:representatives,id',
            'start_date' => 'required|date',
            'type' => 'required|in:laboral,servicio a la comunidad',
            'wide_field' => 'required|string|max:255',
            'specific_field' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'student_activities' => 'required|string|min:40',
            'institutional_agreement_code' => 'nullable|string|required_with:institutional_agreement_name',
            'institutional_agreement_name' => 'nullable|string|required_with:institutional_agreement_code',
            'research_project_code' => 'nullable|string|required_with:research_project_name',
            'research_project_name' => 'nullable|string|required_with:research_project_code',
            'social_project_code' => 'nullable|string|required_with:social_project_code',
            'social_project_name' => 'nullable|string|required_with:social_project_code',
        ]);
        $internship = new Internship($request->only([
            'representative_id',
            'start_date',
            'type',
            'wide_field',
            'specific_field',
            'area',
            'student_activities',
            'institutional_agreement_code',
            'institutional_agreement_name',
            'research_project_code',
            'research_project_name',
            'social_project_code',
            'social_project_name',
        ]));
        $internship->save();

        //Upload information
        $informacion = [
            'usuario' => Auth::user(),
            'datosSolicitud' => $internship,
            'representante' => $internship->representative->user,
            'compania' => $internship->representative->company->name,
        ];

        // Send email to student
        Mail::to([Auth::user()->email,])
            ->send(new NotifyStudentUpdateInternshipProcessMail($informacion));

        // Send mail to representative
        Mail::to([$internship->representative->user->email])
            ->send(new NotifyRepresentativeUpdateInternshipProcessMail($informacion));

        // Send mail to commissio
        Mail::to([config('app.mail_commission'),])
            ->send(new NotifyCommissionUpdateInternshipProcessMail($informacion));

        return response()->json(new InternshipResource($internship), 201);
    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param Request $request
//     * @param \App\Internship $internship
//     * @return JsonResponse
//     * @throws AuthorizationException
//     */
//    public function authorization(Request $request, Internship $internship)
//    {
//        $this->authorize('authorization', $internship);
//        $internship->status = 'in_progress';
//        $internship->save();
//
//        // todo send mail to student
//        // todo send mail to representative
//        // todo send mail to commission
//        // todo send mail to teacher tutor
//
//        return response()->json($internship, 200);
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Internship $internship
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function assignTeacher(Request $request, Internship $internship)
    {
        $this->authorize('assignTeacher', $internship);
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id'
        ]);
        $internship->teacher_id = $request->teacher_id;
        if ($internship->status === 'pending') {
            $internship->status = 'in_progress';
        }
        $internship->save();

        //Upload information
        $informacion = [
            'estudiante' => $internship->student->user,
            'profesor' => $internship->teacher->user,
            'representante' => $internship->representative->user,
        ];
        // Send email to student
        Mail::to([$internship->student->user->email])
            ->send(new NotifyStudentTeacherAssignmentMail($informacion));

        // Send mail to representative
        Mail::to([$internship->representative->user->email])
            ->send(new NotifyRepresentativeTeacherAssignmentMail($informacion));

        // Send mail to commission
        // Preguntar correo de comision
        Mail::to([config('app.mail_commission')])
            ->send(new NotifyCommissionTeacherAssignmentMail($informacion));

        // Send mail to teacher
        Mail::to([$internship->teacher->user->email])
            ->send(new NotifyTeacherTeacherAssignmentMail($informacion));

        return response()->json(new InternshipResource($internship), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Internship $internship
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function setStudentSection(Request $request, Internship $internship)
    {
        $this->authorize('setStudentSection', $internship);
        $request->validate([
            'finish_date' => 'required|date|before_or_equal:today',
            'hours_worked' => 'required|integer|min:1',
            'student_observations' => 'required|string|min:40',
            'activities' => 'required|array|min:1',
            'useful_topics' => 'required|array|min:1',
            'recommended_topics' => 'nullable|array|min:1'
        ]);

        $internship->finish_date = $request->finish_date;
        $internship->hours_worked = $request->hours_worked;
        $internship->student_observations = $request->student_observations;
        $internship->status = 'representative_pending';

        $activities = [];
        foreach ($request->get('activities') as $activity) {
            $activities[] = new InternshipActivity(['description' => $activity]);
        }

        $usefulTopics = [];
        foreach ($request->get('useful_topics') as $usefulTopicId) {
            $usefulTopics[] = Topic::findOrFail($usefulTopicId);
        }

        $recommendedTopics = [];
        if ($request->get('recommended_topics') !== null) {
            foreach ($request->get('recommended_topics') as $recommendedTopic) {
                $recommendedTopics[] = new RecommendedTopic(['name' => $recommendedTopic]);
            }
        }

        $internship->save();

        $internship->activities()->delete();
        $internship->activities()->saveMany($activities);

        $internship->usefulTopics()->sync($request->get('useful_topics'));

        $internship->recommendedTopics()->delete();
        $internship->recommendedTopics()->saveMany($recommendedTopics);

        //Upload information
        $informacion = [
            'estudiante' => $internship->student->user,
            'profesor' => $internship->teacher->user,
            'representante' => $internship->representative->user,
            'compania' => $internship->representative->company->name,
            'practica' => $internship,
            'actividades' => $internship->activities,
        ];

        // Send email to student
        Mail::to([$internship->student->user->email])
            ->send(new NotifyStudentSetStudentSectionMail($informacion));

        // Send mail to representative
        Mail::to([$internship->representative->user->email])
            ->send(new NotifyRepresentativeSetStudentSectionMail($informacion));

        // Send mail to commission
        Mail::to([config('app.mail_commission'),])
            ->send(new NotifyCommissionSetStudentSectionMail($informacion));

        // Send mail to teacher tutor
        Mail::to([$internship->teacher->user->email])
            ->send(new NotifyTeacherSetStudentSectionMail($informacion));

        return response()->json(new InternshipResource($internship), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Internship $internship
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function setRepresentativeSection(Request $request, Internship $internship)
    {
        $this->authorize('setRepresentativeSection', $internship);
        $request->validate([
            'evaluation_punctuality',
            'evaluation_performance',
            'evaluation_motivation',
            'evaluation_knowledge',
            'evaluation_observations',
        ]);

        $internship->evaluation_punctuality = $request->evaluation_punctuality;
        $internship->evaluation_performance = $request->evaluation_performance;
        $internship->evaluation_motivation = $request->evaluation_motivation;
        $internship->evaluation_knowledge = $request->evaluation_knowledge;
        $internship->evaluation_observations = $request->evaluation_observations;
        $internship->status = 'tutor_pending';
        $internship->save();

        return response()->json(new InternshipResource($internship), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Internship $internship
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function setTutorSection(Request $request, Internship $internship)
    {
        $this->authorize('setTutorSection', $internship);
        $request->validate([
            'tutor_observations',
            'tutor_recommends',
            'tutor_recommends_observations',
            'tutor_knowledge_contribution',
            'tutor_knowledge_contribution_observations',
            'tutor_recommends_approval',
            'tutor_recommends_approval_observations',
        ]);

        $internship->tutor_observations = $request->tutor_observations;
        $internship->tutor_recommends = $request->tutor_recommends;
        $internship->tutor_recommends_observations = $request->tutor_recommends_observations;
        $internship->tutor_knowledge_contribution = $request->tutor_knowledge_contribution;
        $internship->tutor_knowledge_contribution_observations = $request->tutor_knowledge_contribution_observations;
        $internship->tutor_recommends_approval = $request->tutor_recommends_approval;
        $internship->tutor_recommends_approval_observations = $request->tutor_recommends_approval_observations;
        $internship->status = 'commission_pending';
        $internship->save();

        return response()->json(new InternshipResource($internship), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Internship $internship
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function setCommissionSection(Request $request, Internship $internship)
    {
        $this->authorize('setCommissionSection', $internship);
        $request->validate([
            'commission_approves' => 'required|boolean',
            'commission_observations' => 'required_if:commission_approves,0',
            'set_status_to' => 'required_if:commission_approves,0|in:in_progress,representative_pending,tutor_pending'
        ]);

        $internship->commission_approves = $request->commission_approves;
        $internship->commission_observations = $request->commission_observations;
        if ($internship->commission_approves) {
            $internship->status = 'approved';
        } else {
            $internship->status = $request->set_status_to;
        }

        $internship->save();

        return response()->json(new InternshipResource($internship), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Internship $internship
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function registerInternship(Request $request, Internship $internship)
    {
        $this->authorize('registerInternship', $internship);
        $internship->status = 'registered';
        $internship->save();

        return response()->json(new InternshipResource($internship), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Internship $internship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Internship $internship)
    {
        //
    }


    /**
     * Display the student reports.
     *
     * @param \App\Internship $internship
     * @return JsonResponse pdf
     * @throws AuthorizationException
     */
    public function report(Internship $internship)
    {
        //dd($internship->usefulTopics->groupBy('subject_id'));
        //$this->authorize('view', $internship);
        $internshipData = $internship->toArray();
        $useful_topics = $internship->usefulTopics->groupBy('subject_id');
        $student = $internship->student->user->toArray();
        $carrer = $internship->student->career->toArray();
        $representative = $internship->representative->user->toArray();
        $representative_company = $internship->representative->toArray();
        $company = $internship->representative->company->toArray();
        $teacher = $internship->teacher->user->toArray();
        $teacher_info = $internship->teacher->toArray();
        $followups = $internship->followups->toArray();

        $data = ["internship"=>$internshipData,
                "useful_topics"=>$useful_topics,
                "student"=>$student,
                "student_email"=> $internship->student->user->email,
                "carrer"=>$carrer,
                "representative"=>$representative,
                "representative_company"=>$representative_company,
                "company"=>$company,
                "teacher"=>$teacher,
                "teacher_info"=>$teacher_info,
                "followups"=>$followups
        ];

        $pdf = PDF::loadView('reports.studentReport', $data);

        Mail::send('reports.studentReport', $data, function($message)use($data, $pdf) {
            $message->to([$data["student_email"]])
                ->subject("Reporte Estudiante")
                ->attachData($pdf->output(), "reporte_practica_estudiante.pdf");
        });

        return response()->json(new InternshipResource($internship), 200);
    }
}
