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
        Schema::create('compensation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('casual_employee_id');
            $table->decimal('amount', 10, 2);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('casual_employee_id')->references('id')->on('casual_employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compensation');
    }
};
