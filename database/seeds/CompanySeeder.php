<?php

use App\Company;
use App\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $companies = factory(Company::class, 30)->create();

        $representative = factory(App\Representative::class)->create([
            'company_id' => 1
        ]);
        $representative->user()->create(factory(User::class)->raw([
            'email' => "jefe@empresa.com",
            'role' => User::ROLE_REPRESENTATIVE,
        ]));
        foreach ($companies as $company) {
            $representatives = $company->representatives()->saveMany(factory(App\Representative::class, $faker->numberBetween(1, 2))->make());
            foreach ($representatives as $representative) {
                $name = $faker->firstName;
                $lastname = $faker->lastname;
                $representative->user()->create(factory(User::class)->raw([
                    'name' => $name,
                    'lastname' => $lastname,
                    'email' => strtolower("$name.$lastname@$faker->domainName"),
                    'role' => User::ROLE_REPRESENTATIVE,
                ]));
            }
        }
    }
}
