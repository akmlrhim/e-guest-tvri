<?php

namespace Database\Seeders;

use App\Models\HomeTheme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeThemeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		if (HomeTheme::count() == 0) {
			HomeTheme::create(
				[
					'logo' => 'eguest_kalsel.png',
					'background_image' => 'login_bg.jpg'
				]
			);
		}
	}
}
