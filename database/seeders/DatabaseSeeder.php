<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// User::factory(10)->create();
		User::create([
			'name' => 'Admin',
			'email' => 'tvrikalsel@gmail.com',
			'email_verified_at' => now(),
			'password' => Hash::make('admin'),
			'remember_token' => Str::random(10),
		]);
	}
}
