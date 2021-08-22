<?php

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::post('email', 'UserController@sendPasswordUser');
//Route::get('articles', 'ArticleController@index');
//Route::get('categories', 'CategoryController@index');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::post('logout', 'UserController@logout');

    /**
     * USER
     */
    Route::put('user/{user}', 'UserController@changedPasswordUser');
    // FIN USER

    /**
     * CRUD STUDENT
     */
    Route::get('students', 'StudentController@index');
    Route::get('students/{student}', 'StudentController@show');
    Route::post('students', 'StudentController@store');
    Route::put('students/{student}', 'StudentController@update');
    Route::put('students/{student}/disabled', 'StudentController@disable');
    // FIN CRUD STUDENT

    /**
     * UPLOAD AND IMPORT STUDENTS IN DB
     */
    Route::post('students/uploadImportFile', 'StudentController@uploadImportFile');
    //END IMPORT STUDENTS

    // INTERNSHIPS
    Route::get('internships', 'InternshipController@index');
    Route::get('internships/{internship}', 'InternshipController@show');
    Route::post('internships', 'InternshipController@store');
    Route::put('internships/{internship}', 'InternshipController@update');
    Route::put('internships/{internship}/teacher', 'InternshipController@assignTeacher');
    Route::put('internships/{internship}/student', 'InternshipController@setStudentSection');
    Route::put('internships/{internship}/representative', 'InternshipController@setRepresentativeSection');
    Route::put('internships/{internship}/tutor', 'InternshipController@setTutorSection');
    Route::put('internships/{internship}/commission', 'InternshipController@setCommissionSection');
    Route::put('internships/{internship}/registration', 'InternshipController@registerInternship');

    // FOLLOWUPS
    Route::get('internships/{internship}/followups', 'FollowupController@index');
    Route::post('internships/{internship}/followups', 'FollowupController@store');

    Route::get('companies', 'CompanyController@index');
    Route::get('companies/{company}', 'CompanyController@show');
    Route::get('companies/ruc/{ruc}', 'CompanyController@byRUC');
    Route::post('companies', 'CompanyController@store');
    Route::put('companies/{company}', 'CompanyController@update');

    Route::get('companies/{company}/representatives', 'RepresentativeController@index');
    Route::get('companies/{company}/representatives/{representative}', 'RepresentativeController@show');
    Route::post('companies/{company}/representatives', 'RepresentativeController@store');
    Route::put('companies/{company}/representatives/{representative}', 'RepresentativeController@update');

    /**
     * CRUD CAREER
     */
    Route::get('careers', 'CareerController@index');
    Route::get('careers/{career}', 'CareerController@show');
    Route::post('careers', 'CareerController@store');
    Route::put('careers/{career}', 'CareerController@update');
    Route::put('careers/{career}/disabled', 'CareerController@disable');
    // FIN CRUD CAREER

    Route::get('careers/{career}/subjects', 'SubjectController@index');
    Route::get('careers/{career}/subjects/topics', 'TopicController@getCareerSubjectsTopics');
    Route::get('careers/{career}/subjects/{subject}/topics', 'TopicController@index');

    /**
     * CRUD ADMINISTRATIVES
     */
    Route::get('administratives', 'AdministrativeController@index');
    Route::get('administratives/{administrative}', 'AdministrativeController@show');
    Route::post('administratives', 'AdministrativeController@store');
    Route::put('administratives/{administrative}', 'AdministrativeController@update');
    Route::put('administratives/{administrative}/disabled', 'AdministrativeController@disable');
    // FIN CRUD ADMINISTRATIVES

    /**
     * CRUD TEACHER
     */
    Route::get('teachers', 'TeacherController@index');
    Route::get('teachers/{teacher}', 'TeacherController@show');
    Route::post('teachers', 'TeacherController@store');
    Route::put('teachers/{teacher}', 'TeacherController@update');
    Route::put('teachers/{teacher}/disabled', 'TeacherController@disable');
    // FIN CRUD TEACHER

    /*
     * CRUD TOPIC
     */
    Route::get('topics', 'TopicController@all');
    Route::get('topics/{topic}', 'TopicController@show');
    Route::post('topics', 'TopicController@store');
    Route::put('topics/{topic}', 'TopicController@update');
    Route::put('topics/{topic}/disabled', 'TopicController@disable');
    // FIN CRUD TOPIC

    /**
     * CRUD SUBJECT
     */
    Route::get('subjects', 'SubjectController@index');
    Route::get('subjects/{subject}', 'SubjectController@show');
    Route::post('subjects', 'SubjectController@store');
    Route::put('subjects/{subject}', 'SubjectController@update');
    Route::put('subjects/{subject}/disabled', 'SubjectController@disable');
    // FIN CRUD SUBJECT

    /**
     * CRUD FACULTY
     */
    Route::get('faculties', 'FacultyController@index');
    Route::get('faculties/{faculty}', 'FacultyController@show');
    Route::post('faculties', 'FacultyController@store');
    Route::put('faculties/{faculty}', 'FacultyController@update');
    Route::put('faculties/{faculty}/disabled', 'FacultyController@disable');
    // FIN CRUD FACULTY

});
