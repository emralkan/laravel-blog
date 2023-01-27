<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class pageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=['Hakkımızda', 'İletişim' , 'Kariyer'];
        $count=0;
        foreach($pages as $page){
            $count++;
            DB::table('pages')->insert([
                'title'=>$page,
                'slug'=>$page,
                'image'=>'https://media.istockphoto.com/id/1270310743/tr/vekt%C3%B6r/gen%C3%A7-adam-%C3%A7al%C4%B1%C5%9F%C4%B1yor-ya-da-evden-%C3%B6%C4%9Freniyor.jpg?s=170667a&w=0&k=20&c=e7a9t4eGQpMkXGGEzKQkI8inEqhnS8Row3Ls18vxKzc=',
                'content'=>'loremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremlorem',
                'order'=>$count,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
