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
        Schema::table('casual_employees', function (Blueprint $table) {
            $table->string('first_name');
            $table->string('last_name');
            $table->string('id_number')->unique();
            $table->string('casual_code')->unique();
            $table->string('branch');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('department');
            $table->decimal('rate_per_day', 10, 2);
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('casual_employees', function (Blueprint $table) {
            $table->string('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('id_number');
            $table->dropColumn('casual_code');
            $table->dropColumn('branch');
            $table->dropColumn('phone_number');
            $table->dropColumn('gender');
            $table->dropColumn('department');
            $table->dropColumn('rate_per_day');
            $table->dropTimestamps();
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }
};