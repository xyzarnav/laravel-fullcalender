<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventColorCodingAndEventPriorityToYourTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            // $table->string('event_color_coding', 7)->nullable();
            // $table->boolean('event_priority')->default(0);
            // $table->time('event_start_time')->default('00:00:00');
            // $table->time('event_end_time')->default('00:00:00');
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
            // $table->dropColumn('event_color_coding');
            // $table->dropColumn('event_priority');
            // $table->dropColumn('event_start_time');
            // $table->dropColumn('event_end_time');
        });
    }
}

