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
            if (!Schema::hasColumn('casual_employees', 'first_name')) {
                $table->string('first_name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('casual_employees', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('first_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('casual_employees', function (Blueprint $table) {
            $table->dropColumn('first_name');
        });
        Schema::table('casual_employees', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
