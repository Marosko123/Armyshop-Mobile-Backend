<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(UsersSeeder::class);
		$this->call(ProductsSeeder::class);
		$this->call(BasketsSeeder::class);
		$this->call(FinishedOrdersSeeder::class);
		$this->call(CategoriesSeeder::class);
		$this->call(SubcategoriesSeeder::class);
		$this->call(ChatRoomsSeeder::class);
		$this->call(MessagesSeeder::class);
	}
}