<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCarsTable.
 */
class CreateCarsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cars', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('model');
            $table->year('year');
            $table->text('description')->nullable();
            $table->uuid('brand_id')->index();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->softDeletes();
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
		Schema::drop('cars');
	}
}
