<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('home_theme', function (Blueprint $table) {
			$table->id();
			$table->string('logo');
			$table->string('background_image');
			$table->timestamps();
		});

		Artisan::call('db:seed', ['--class' => 'HomeThemeSeeder']);
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('home_theme');
	}
};
