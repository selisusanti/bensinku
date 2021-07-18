<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTblComponentLabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_tbl_component_label', function (Blueprint $table) {
            $table->id();
			$table->string('component_id',255)->nullable();
			$table->string('name_component',100)->nullable();
			$table->boolean('type_component')->nullable();
			$table->string('title',255)->nullable();
			$table->string('wording',255)->nullable();
            $table->timestamps();
			$table->softDeletes($column = 'delete_time', $precision = 0);
			$table->boolean('is_delete')->nullable();
            $table->bigInteger('lang_id', false, true)->nullable();
            $table->foreign('lang_id')->references('id')->on('cms_tbl_language');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_tbl_component_label');
    }
}
