<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTblFaqSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_tbl_faq_setting', function (Blueprint $table) {
            $table->id();
            $table->string('email',50)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('whatsapp',20)->nullable();
            $table->text('background_image')->nullable();
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
        Schema::dropIfExists('cms_tbl_faq_setting');
    }
}
