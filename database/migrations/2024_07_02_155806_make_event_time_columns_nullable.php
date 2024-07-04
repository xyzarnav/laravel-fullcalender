<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeEventTimeColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('event_color_coding', 7)->nullable();
            $table->boolean('event_priority')->default(0);
            $table->time('event_start_time')->nullable()->change();
            $table->time('event_end_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('event_color_coding');
            $table->dropColumn('event_priority');
            $table->time('event_start_time')->nullable(false)->change();
            $table->time('event_end_time')->nullable(false)->change();
        });
    }
}

