<?php

use App\Models\Monitor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
	{
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
			$table->foreignIdFor(Monitor::class)->constrained()->cascadeOnDelete();
			$table->tinytext('event');
			$table->mediumInteger('code')->nullable();
			$table->text('reason')->nullable();
			$table->timestamp('date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
	{
        Schema::dropIfExists('logs');
    }
};
