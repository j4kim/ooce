<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddGroupIdAndRefInThingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('things', function (Blueprint $table) {
            $table->foreignId('group_id')->nullable()->constrained();
            $table->integer('ref')->nullable();
            $table->unique(['group_id', 'ref']);
            $table->boolean('is_root')->default(false);
        });

        DB::update('update things set group_id = 1, ref = id');

        Schema::table('things', function (Blueprint $table) {
            $table->bigInteger('group_id')->nullable(false)->change();
            $table->integer('ref')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('things', function (Blueprint $table) {
            $table->dropColumn(['ref', 'is_root']);
            if (env('DB_CONNECTION') != 'sqlite') {
                $table->dropUnique(['group_id', 'ref']);
                $table->dropForeign('group_id');
            }
        });
    }
}
