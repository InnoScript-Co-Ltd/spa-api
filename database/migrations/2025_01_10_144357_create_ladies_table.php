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
        Schema::create('ladies', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('profile');
            $table->string('name');
            $table->string('nrc');
            $table->string('phone')->unique();
            $table->date('dob');
            $table->string('address');
            $table->datetime('join_date');
            $table->datetime('leave_date');
            $table->auditColumns();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ladies');
    }
};
