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
		Schema::create('guests', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('origin');
			$table->string('email');
			$table->string('phone_number');
			$table->string('gender');
			$table->string('objectives');
			$table->string('photo', 2048)->nullable()->default('default.jpg');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('guests');
	}
};
