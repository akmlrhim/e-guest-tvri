<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		if (User::count() == 0) {
			User::create([
				'name' => 'Admin',
				'email' => 'tvrikalsel@gmail.com',
				'email_verified_at' => now(),
				'password' => Hash::make('admin'),
				'remember_token' => Str::random(10),
			]);
		}
	}
}
