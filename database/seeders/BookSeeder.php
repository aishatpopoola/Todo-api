<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert(array(
            0 => array(
                'id' => 1,
                'name' => 'Sweet world',
                'user_id' => 1,
                'book_id' => 'book1',
                'author' => 'Lionel richie',
                'chapters' => 12,
                'genre' => 'romance',
            ),
            1 => array(
                'id' => 2,
                'name' => 'walking dead',
                'user_id' => 2,
                'book_id' => 'book2',
                'author' => 'Amc',
                'chapters' => 50,
                'genre' => 'horror',
            ),
            2 => array(
                'id' => 3,
                'name' => 'Mr governor',
                'user_id' => 1,
                'book_id' => 'book3',
                'author' => 'Lionel richie',
                'chapters' => 10,
                'genre' => 'romance',
            ),
        ));
    }
}
