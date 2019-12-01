<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => str_random(10),
        //     'email' => str_random(4).'@gmail.com',
        //     'password' => bcrypt('secret'),
        // ]);

        // DB::table('admins')->insert([
        //     'name' => str_random(10),
        //     'email' => str_random(4).'@gmail.com',
        //     'password' => bcrypt('password'),
        // ]);

        // DB::table('products')->insert([
        //     'name' => str_random(4),
        //     'sku' => str_random(10),
        //     'price' => str_random(3),
        //     'description' => str_random(100),
        // ]);

        $faker = Faker\Factory::create();

        $limit = 15;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([ //,
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('secret'),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('admins')->insert([ //,
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('password'),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {
            DB::table('products')->insert([ //,
                'name' => $faker->name,
                'sku' => $faker->name,
                'price' => $faker->randomDigit,
                'description' => $faker->text,
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }
    }
}
