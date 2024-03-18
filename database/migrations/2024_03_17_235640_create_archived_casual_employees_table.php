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
        Schema::create('archived_casual_employees', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('id_number')->unique();
            $table->string('casual_code')->unique();
            $table->string('branch');
            $table->string('phone_number');
            $table->string('gender');$table->string('first_name');
            $table->string('department');
            $table->decimal('rate_per_day', 10, 2);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archived_casual_employees');
    }
};
