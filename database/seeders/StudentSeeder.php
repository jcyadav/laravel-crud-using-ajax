<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Book;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	for ($i=1; $i < 25000; $i++) { 
    	$book = new Book;
          $book->name = $faker->name;
          $book->email = $faker->email;
          $book->mobile = '7348464639';
          $book->class = 'MCA';
          $book->father_name = 'King';
          $book->mother_name = 'Queen';
          $book->save();
    	}
          
    }
}
