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
		Schema::create('interns', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('gender');
			$table->string('institution');
			$table->string('birthplace');
			$table->date('date_of_birth');
			$table->date('start');
			$table->date('end');
			$table->string('email');
			$table->string('phone_number');
			$table->text('address');
			$table->string('parent_number');
			$table->string('photo')->default('default.jpg');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('internships');
	}
};
