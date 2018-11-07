<?php

use Illuminate\Database\Seeder;

use App\Bid;
use Faker\Factory as Faker;
use Carbon\Carbon;


class BidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $postingNumber = 100;

        for($i = 0; $i < 11; $i++){
            $bid = new Bid();

            $bid->posting_number = "18-".$postingNumber;
            $bid->is_active = $faker->randomElement($array = array(0, 1));
            $bid->post_date = $faker->numberBetween($min = 1, $max = 12).'/'.$faker->numberBetween($min = 1, $max = 25).'/2018';
            $bid->pull_date = $faker->numberBetween($min = 1, $max = 12).'/'.$faker->numberBetween($min = 1, $max = 25).'/2018';
            $bid->team_id = $faker->numberBetween($min = 1, $max = 9);
            $bid->position_id = $faker->numberBetween($min = 1, $max = 61);
            $bid->shift_id = $faker->numberBetween($min = 1, $max = 2);
            $bid->number_of_openings = $faker->numberBetween($min = 1, $max = 10);
            $bid->bid_top_wage_id = $faker->numberBetween($min = 16, $max = 90);
            $bid->bid_education_top_wage_id = $faker->numberBetween($min = 16, $max = 90);
            $bid->education_requirement = $faker->randomElement($array = array(0, 1));
            $bid->resume_required = $faker->randomElement($array = array(0, 1));
            $bid->tech_form_required = $faker->randomElement($array = array(0, 1));
            $bid->summary = $faker->text($maxNbChars = 500);
            $bid->essential_duties_responsibilities = $faker->text($maxNbChars = 500);
            $bid->qualifications = $faker->text($maxNbChars = 500);
            $bid->successful_bidder = $faker->text($maxNbChars = 500);
            $bid->education_experience = $faker->text($maxNbChars = 500);
            $bid->physical_demands = $faker->text($maxNbChars = 500);
            $bid->math_skills = $faker->text($maxNbChars = 500);

            $bid->save();


            $postingNumber++;
        }
        
    }
}
