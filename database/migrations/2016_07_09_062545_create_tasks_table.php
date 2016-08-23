<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('preset_freq')->nullable();
            $table->string('unit_key')->nullable();
            $table->integer('unit_value')->nullable();
            $table->time('run_at')->nullable();
            $table->string('weekday')->nullable();
            $table->string('cron_expression')->nullable();
            $table->text('description')->nullable();
            $table->date('run_date')->nullable();
            $table->date('up_date')->nullable();
            $table->time('up_time')->nullable();
            $table->date('sleep_date')->nullable();
            $table->time('sleep_time')->nullable();
            $table->string('run_in')->nullable();
            $table->string('run');
            $table->string('ping_before')->nullable();
            $table->string('ping_after')->nullable();
            $table->string('output_log')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('prevent_overlapping')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
