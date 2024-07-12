<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DraftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drafts')->insert([
            'title' => 'タイトル',
            'body' => '本文',
            'user_id' => 1
        ]);
        DB::table('drafts')->insert([
            'title' => 'タイトル',
            'body' => '本文本文本文本文本文本文本文本文本文',
            'user_id' => 1
        ]);
        DB::table('drafts')->insert([
            'title' => 'タイトル2',
            'body' => '本文2',
            'user_id' => 2
        ]);
    }
}
