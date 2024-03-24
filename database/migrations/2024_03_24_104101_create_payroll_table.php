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
        Schema::create('payroll', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('payroll')->nullable();
            $table->text('overtimes')->nullable();
            $table->text('cashes')->nullable();
            $table->text('deductions')->nullable();
            $table->text('empDeduction')->nullable();
            $table->text('empCashes')->nullable();
            $table->date('from');
            $table->date('to');
            $table->string('from_error')->nullable();
            $table->string('to_error')->nullable();
            $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll');
    }
};
