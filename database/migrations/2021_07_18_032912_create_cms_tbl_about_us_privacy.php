<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTblAboutUsPrivacy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_tbl_about_us_privacy', function (Blueprint $table) {
            $table->id();
            $table->text('url')->nullable();
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
        Schema::dropIfExists('cms_tbl_about_us_privacy');
    }
}
