<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('speakers', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('origin');
			$table->string('gender');
			$table->string('phone_number');
			$table->unsignedBigInteger('program_id');
			$table->date('date_of_visit');

			$table->string('photo', 2048)->nullable()->default('default.jpg');
			$table->foreign('program_id')->references('id')->on('programs');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('speakers');
	}
};
