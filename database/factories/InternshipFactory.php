<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Internship;
use Faker\Generator as Faker;

$factory->define(Internship::class, function (Faker $faker) {

    $started_at = $faker->dateTimeBetween('-4 years');
    $representatives = \App\Representative::all();
    $numMonths = $faker->numberBetween(1, 4);
    $students = \App\Student::all();

    $internshipData = [
        'student_id' => $faker->randomElement($students),
        'start_date' => $started_at,
        'type' => $faker->randomElement(['laboral', 'servicio a la comunidad']),
        'wide_field' => $faker->sentence(3),
        'specific_field' => $faker->sentence(2),
        'area' => $faker->jobTitle,
        'student_activities' => $faker->paragraph,
        'representative_id' => $faker->randomElement($representatives),
        'status' => $faker->randomElement([
            'pending',
            'rejected',
            'in_progress',
            'representative_pending',
            'tutor_pending',
            'commission_pending',
            'approved',
            'registered'
        ])
    ];

    if ($internshipData['status'] !== 'pending') {
        $admnistratives = \App\Administrative::all();

        $internshipData['authorized_by'] = $faker->randomElement($admnistratives);

        if ($internshipData['status'] !== 'rejected') {
            $teachers = \App\Teacher::all();
            $teacher = $faker->randomElement($teachers);
            $internshipData['teacher_id'] = $teacher;

            if ($internshipData['status'] !== 'in_progress') {
                $internshipData = array_merge($internshipData, [
                    'finish_date' => $faker->dateTimeInInterval($started_at->format('Y-m-d'), '+' . $numMonths . ' months'),
                    'hours_worked' => $faker->numberBetween(20, 480),
                    'student_observations' => $faker->paragraph,
                ]);

                if ($internshipData['status'] !== 'representative_pending') {
                    $internshipData = array_merge($internshipData, [
                        'evaluation_punctuality' => $faker->numberBetween(1, 4),
                        'evaluation_performance' => $faker->numberBetween(1, 4),
                        'evaluation_motivation' => $faker->numberBetween(1, 4),
                        'evaluation_knowledge' => $faker->numberBetween(1, 4),
                        'evaluation_observations' => $faker->paragraph,
                    ]);

                    if ($internshipData['status'] !== 'tutor_pending') {
                        $internshipData = array_merge($internshipData, [
                            'tutor_observations' => $faker->paragraph,
                            'tutor_recommends' => $faker->boolean(80),
                            'tutor_recommends_observations' => $faker->paragraph,
                            'tutor_knowledge_contribution' => $faker->boolean(80),
                            'tutor_knowledge_contribution_observations' => $faker->paragraph,
                            'tutor_recommends_approval' => $faker->boolean(90),
                            'tutor_recommends_approval_observations' => $faker->paragraph,
                        ]);

                        if ($internshipData['status'] !== 'commission_pending') {
                            $internshipData = array_merge($internshipData, [
                                'commission_approves' => $internshipData['status'] === 'approved' || $internshipData['status'] === 'registered',
                                'commission_observations' => $faker->paragraph
                            ]);
                        }
                    }
                }
            }
        }
    }

    return $internshipData;
});
