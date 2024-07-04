<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'event_color_coding')) {
                $table->string('event_color_coding', 7)->nullable();
            }
            if (!Schema::hasColumn('events', 'event_priority')) {
                $table->boolean('event_priority')->default(0);
            }
            if (!Schema::hasColumn('events', 'event_start_time')) {
                $table->time('event_start_time')->nullable();
            } else {
                $table->time('event_start_time')->nullable()->change();
            }
            if (!Schema::hasColumn('events', 'event_end_time')) {
                $table->time('event_end_time')->nullable();
            } else {
                $table->time('event_end_time')->nullable()->change();
            }
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
            // Only attempt to revert changes if the columns exist
            if (Schema::hasColumn('events', 'event_start_time')) {
                $table->time('event_start_time')->nullable(false)->change();
            }
            if (Schema::hasColumn('events', 'event_end_time')) {
                $table->time('event_end_time')->nullable(false)->change();
            }
        });
    }
}
