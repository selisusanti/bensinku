<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTblPromo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_tbl_promo', function (Blueprint $table) {
            $table->id();
			$table->string('promo_name', 20)->nullable();
			$table->string('company_vendor', 100)->nullable();
			$table->string('code', 50)->nullable();
			$table->tinyInteger('qty')->nullable();
			$table->smallInteger('percentage')->nullable();
			$table->dateTime('expired')->nullable();
			$table->text('description')->nullable();
			$table->boolean('status')->nullable();
			$table->decimal('minimum_pembelian', 10, 2)->nullable();
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
        Schema::dropIfExists('cms_tbl_promo');
    }
}
