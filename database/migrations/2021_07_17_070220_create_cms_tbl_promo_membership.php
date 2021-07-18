<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTblPromoMembership extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_tbl_promo_membership', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('user_id');
            $table->bigInteger('promo_id', false, true)->nullable();
            $table->foreign('promo_id')->references('id')->on('cms_tbl_promo');
			$table->string('username',100);
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
        Schema::dropIfExists('cms_tbl_promo_membership');
    }
}
