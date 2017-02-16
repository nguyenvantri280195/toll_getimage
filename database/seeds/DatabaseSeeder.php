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
        $this->call(UserTableSeeder::class);
        // $this->call(LinkTableSeeder::class);
        
    }
}  
// class LinkTableSeeder extends Seeder{
//     public function run(){
//         DB::table('links')->insert([
//             ['link'=>'http://ih0.redbubble.net/image.329871085.1942/raf,750x1000,075,f,101010:01c5ca27c6.u1.jpg',
//              'name'=>'I Love HUNTING and Being PAPA Unisex ', 
//              'user_id'=>1,
//              'folder'=>'hinhanh'
//              ]
//         ]);
//     }
// } 
class UserTableSeeder extends Seeder{
    public function run(){
        DB::table('users')->insert([
            ['name'=>'admin',
             'email'=>'nguyenvantri@gmail.com',
             'password'=>'$2y$10$QRbTCekk2bog5jjIRf/WuOvCaGtJj8Z6CyGBvhqyZuOsUk/UFnfkC',
             'level'=>1,
             'remember_token'=>'58msgx26OQ2K4VnveEV4Ruzy8TgLy8Fmqmi6QOLPOc97EsNkFQjxr3tCGlzL'
             ]
        ]);
    }
} 
