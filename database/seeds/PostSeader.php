<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
           ['user_id'=>3, 'title'=>'Post one', 'content'=>'Content For Post one'],
            ['user_id'=>3, 'title'=>'Post two', 'content'=>'Content For Post two'],
            ['user_id'=>3, 'title'=>'Post three', 'content'=>'Content For Post three'],
            ['user_id'=>3, 'title'=>'Post four', 'content'=>'Content For Post four'],
        ]);
    }
}
