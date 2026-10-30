<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Guzzle 8 preserves HTTP method casing, so store methods in uppercase.
 */
return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::table('monitors', function (Blueprint $table) {
			$table->string('uptime_check_method')->default('GET')->change();
		});

		DB::table('monitors')->update(['uptime_check_method' => DB::raw('UPPER(uptime_check_method)')]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::table('monitors', function (Blueprint $table) {
			$table->string('uptime_check_method')->default('get')->change();
		});

		DB::table('monitors')->update(['uptime_check_method' => DB::raw('LOWER(uptime_check_method)')]);
	}
};
