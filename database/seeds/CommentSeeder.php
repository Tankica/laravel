<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            ['user_id'=>3, 'post_id'=>1, 'content'=>"Comment 1"],
            ['user_id'=>3, 'post_id'=>1, 'content'=>"Comment 2"],
            ['user_id'=>3, 'post_id'=>1, 'content'=>"Comment 3"],
            ['user_id'=>3, 'post_id'=>2, 'content'=>"Comment 4"],
            ['user_id'=>3, 'post_id'=>3, 'content'=>"Comment 5"],
        ]);
    }
}
