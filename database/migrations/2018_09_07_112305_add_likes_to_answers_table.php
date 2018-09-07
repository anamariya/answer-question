<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLikesToAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->integer('likes_amount')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *k
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            //
        });
    }
}
