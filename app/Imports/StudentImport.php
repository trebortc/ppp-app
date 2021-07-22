<?php

namespace App\Imports;

use App\Student;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class StudentImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $plain_password = Str::random(8);
        $user = User::where('email', '=', $row['email'])->first();
        if($user == null)
        {
            /*
            * Store user
            */
            $user = new User();
            $user->name = $row['name'];
            $user->lastname = $row['lastname'];
            $user->email = $row['email'];
            $user->phone = $row['phone'];
            $user->mobile = $row['mobile'];
            $user->sex = $row['sex'];
            $user->status = 'active';
            $user->password = Hash::make($plain_password);

            /*
            * Store student
            */
            $student = new Student();
            $student->career_id = $row['career_id'];
            $student->save();
            $student->user()->save($user);
        }
        else
        {
            /*
             * Update student
             */
            $student = $user->userable;
            $student->career_id = $row['career_id'];
            $student->save();

            /*
             * Update user
             */
            $user->name = $row['name'];
            $user->lastname = $row['lastname'];
            $user->phone = $row['phone'];
            $user->mobile = $row['mobile'];
            $user->sex = $row['sex'];
            $user->save();
        }
        return null;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function batchSize(): int
    {
        return 100;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'career_id' => 'required|exists:careers,id|integer',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => ['required', 'regex:/^[a-zA-Z0-9]+(.)+[a-zA-Z0-9]+@epn.edu.ec$/i', 'max:45'],
            'phone' => 'string|max:9',
            'mobile' => 'string|max:10',
            'sex' => 'required|in:male,female',
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'career_id' => 'career_student',
            'name' => 'name_student',
            'lastname' => 'lastname_student',
            'email' => 'email_student',
            'phone' => 'phone_student',
            'mobile' => 'mobile_students',
            'sex' => 'sex_student',
        ];
    }
}
