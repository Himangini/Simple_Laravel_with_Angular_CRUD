<?php 

class CommentTableSeeder extends Seeder {

    public function run()
    {
        DB::table('comments')->delete();
    
        Comment::create(array(
            'author' => 'Himangini Daware',
            'text' => 'Look I am a test comment.'
        ));
    
        Comment::create(array(
            'author' => 'Himangini Daware',
            'text' => 'Look I am a test comment.'
        ));
    
    }    

}