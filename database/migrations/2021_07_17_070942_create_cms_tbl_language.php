<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTblLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_tbl_language', function (Blueprint $table) {
            $table->id();
			$table->string('name',60)->nullable();
            $table->timestamps();
			$table->softDeletes($column = 'delete_time', $precision = 0);
			$table->boolean('is_delete')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_tbl_language');
    }
}
