<?php

use Illuminate\Database\Seeder;
use App\Thread;
class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thread = new Thread();
        $thread->name = 'D5555';
        $thread->description = 'Forum ini tentang dosen dengan kode D5555';
        $thread->status = 1;
        $thread->category_id = 1;
        $thread->save();
    }
}
