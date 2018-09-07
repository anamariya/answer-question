<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    public function insert_categories(){
        DB::table('categories')->insert([
            ['name' => 'Category 1', 'created_at' => date('Y-m-d')],
            ['name' => 'Category 2','created_at' => date('Y-m-d')],
            ['name' => 'Category 3','created_at' => date('Y-m-d')]
        ]);
    }
}
