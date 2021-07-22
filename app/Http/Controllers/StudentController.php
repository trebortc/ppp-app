<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Http\Resources\Student as StudentResource;
use App\Imports\StudentImport;
use App\Mail\StudentUserTemporyPasswordMail;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(new StudentCollection(Student::all()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return JsonResponse
     */
    public function show(Student $student)
    {
        $this->authorize('view', $student);
        return response()->json(new StudentResource($student), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', student::class);

        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email'=> ['required', 'regex:/^[a-zA-Z0-9]+(.)+[a-zA-Z0-9]+@epn.edu.ec$/i', 'max:45','email','unique:users'],
            'phone' => 'required|min:7',
            'mobile' => 'min:7',
            'sex' => 'required|in:male,female',
        ]);

        $plain_password = Str::random(8);

        $student = new Student($request->all());
        $student->save();

        $student->user()->create([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'mobile' => $request->get('mobile'),
            'sex' => $request->get('sex'),
            'password' => Hash::make($plain_password),
            'status' => 'active',
        ]);


        return response()->json(new StudentResource($student), 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return JsonResponse
     */
    public function update(Request $request, Student $student)
    {
        $this->authorize('update', $student);
        //'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('representative')->email
        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|unique:users,email,'. $student->user->id.'|string|max:255',
            'phone' => 'required|min:7',
            'mobile' => 'min:7',
            'sex' => 'required|in:male,female',
        ]);

        $plain_password = Str::random(8);
        $student->update($request->all());

        $student->user()->update([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'mobile' => $request->get('mobile'),
            'sex' => $request->get('sex'),
        ]);

        return response()->json(new StudentResource($student), 200);
    }

    /**
     * Disabled the specified resource in storage.
     *
     * @return JsonResponse
     */
    public function disable(Student $student)
    {
        $this->authorize('disable', $student);
        $student->user()->update([
            'status' => 'disabled'
        ]);
        return response()->json(new StudentResource($student), 200);
    }
    /**
     * Upload and Import excel file of students in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function uploadImportFile(Request $request)
    {
        /**
         * Upload Excel file
         **/
        $fileName = 'students.xlsx';
        $request->file('file')->move(public_path('/files'), $fileName);

        /**
         * Import Excel file
         **/
        try{
            Excel::import(new StudentImport(), 'files/students.xlsx');
        }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {

            $failures = $e->failures();
            $collectionFailures = collect();

            foreach ($failures as $failure) {
                $collectionFailures = $collectionFailures->push(
                    [
                        'row' => $failure->row(),
                        'attribute' => $failure->attribute(),
                        'errors' => $failure->errors(),
                        'values' => $failure->values()
                    ]);
            }

            $collectionFailures = $collectionFailures->groupBy('row');
            $collectionByRows = collect();
            foreach ($collectionFailures as $dataByRowsKey => $dataByRows){
                $collectionByRow = collect();
                foreach ($dataByRows as $dataByRow){
                    foreach ($dataByRow as $key => $data){
                        (is_null($collectionByRow->get(''.$key))) ? $dataArray = collect() : $dataArray = $collectionByRow->get(''.$key);
                        $dataArray->push($data);
                        $dataArray = $dataArray->unique();
                        $collectionByRow->put(''.$key, $dataArray);
                    }
                }
                $collectionByRows->put(''.$dataByRowsKey, $collectionByRow);
            }
            return response()->json(['error' => 'import_excel_data', 'error_list' => $collectionByRows], 404);
        }
        return response()->json(['ok'=>'all_data_was_successfully_saved'], 200);
    }
}
