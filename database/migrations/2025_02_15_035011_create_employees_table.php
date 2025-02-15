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
        Schema::create('employees', function (Blueprint $table) {
            $table->snowflakeIdAndPrimary();
            $table->snowflakeId('user_id');
            $table->string('employee_no')->unique();
            $table->string('name');
            $table->string('phone');
            $table->datetime("date");
            $table->string('nrc')->unique();
            $table->string('nrc_front')->nullable()->default(null);
            $table->string('nrc_back')->nullable()->default(null);
            $table->string('address');
            $table->string('father_name');
            $table->string('mother_name');
            $table->datetime('join_date');
            $table->datetime('leave_date');
            $table->string("remark");
            $table->auditColumns();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
