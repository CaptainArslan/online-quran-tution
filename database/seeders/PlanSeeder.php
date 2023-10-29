<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inquiry = App\Models\Country::create([
            'code' => '92',
            'name' => 'pakistan',
            'currency' => 'rupes',
            'created_at' => '2020-08-07 00:00:00',
            'updated_at' => '2020-08-07 07:00:00',
        ]);
        $inquiry->id;
        App\Models\Plan::create([
            'country_id' => $inquiry->id,
            'name' => 'Basic',
            'price' => '1200',
            'discount' => '10',
            'days_in_week' => '12',
            'classes_in_month' => '120',
            'duration' => '12',
            'price_per_month' => '9002',
            'note' => 'dhvbdjhbdjhb',
            'is_featured' => '0',
            'created_at' => '2020-08-07 00:00:00',
            'updated_at' => '2020-08-07 07:00:00',
        ]);
        $inquiry = App\Models\Country::create([
            'code' => '92',
            'name' => 'India',
            'currency' => 'rupes',
            'created_at' => '2020-08-07 00:00:00',
            'updated_at' => '2020-08-07 07:00:00',
        ]);
        $inquiry->id;
        App\Models\Plan::create([
            'country_id' => $inquiry->id,
            'name' => 'Pro',
            'price' => '1200',
            'discount' => '10',
            'days_in_week' => '12',
            'classes_in_month' => '120',
            'duration' => '12',
            'price_per_month' => '9002',
            'note' => 'dhvbdjhbdjhb',
            'is_featured' => '1',
            'created_at' => '2020-08-07 00:00:00',
            'updated_at' => '2020-08-07 07:00:00',
        ]);
        $inquiry = App\Models\Country::create([
            'code' => '92',
            'name' => 'Turkey',
            'currency' => 'rupes',
            'created_at' => '2020-08-07 00:00:00',
            'updated_at' => '2020-08-07 07:00:00',
        ]);
        $inquiry->id;
        App\Models\Plan::create([
            'country_id' => $inquiry->id,
            'name' => 'Gold',
            'price' => '1200',
            'discount' => '10',
            'days_in_week' => '12',
            'classes_in_month' => '120',
            'duration' => '12',
            'price_per_month' => '9002',
            'note' => 'dhvbdjhbdjhb',
            'is_featured' => '1',
            'created_at' => '2020-08-07 00:00:00',
            'updated_at' => '2020-08-07 07:00:00',
        ]);
    }
}
