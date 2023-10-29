<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => '2020-08-07 17:00:00',
            'password' => '$2y$10$iYZp7oq89UR0cUBDLQzdruNjxRqGl9FehohpB7H4jVX9Run/So10W',
            'role' => 'admin',
            'phone' => '123-456-789',
            'created_at' => '2020-08-07 00:00:00',
            'updated_at' => '2020-08-07 07:00:00',
        ]);

        $manager = App\Models\User::create([
            'name' => 'Manager',
            'email' => 'manager@manager.com',
            'email_verified_at' => '2020-08-07 17:00:00',
            'password' => '$2y$10$iYZp7oq89UR0cUBDLQzdruNjxRqGl9FehohpB7H4jVX9Run/So10W',
            'role' => 'manager',
            'phone' => '123-456-789',
            'created_at' => '2020-08-07 00:00:00',
            'updated_at' => '2020-08-07 07:00:00',
        ]);
        $manager->id;
        App\Models\PaymentManager::create([
            'user_id' => $manager->id,
            'address' => 'address b13 lower street Islamabad',

        ]);

        $tutor = App\Models\User::create([
            'name' => 'Tutor',
            'email' => 'tutor@tutor.com',
            'email_verified_at' => '2020-08-07 17:00:00',
            'password' => '$2y$10$iYZp7oq89UR0cUBDLQzdruNjxRqGl9FehohpB7H4jVX9Run/So10W',
            'role' => 'tutor',
            'phone' => '123-456-789',
            'avatar' =>'uploads/avatar/dummy_image.png',
            'created_at' => '2020-08-07 00:00:00',
            'updated_at' => '2020-08-07 07:00:00',
        ]);
        $tutor->id;
        App\Models\Tutor::create([
            'user_id' => $tutor->id,
            'address' => 'b6 12 blue area islamabad',
            'status' => 'pending',
            'biography' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.
              If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.
              All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
             It uses a dictionary of over 200 Latin words',

        ]);
    }
}
