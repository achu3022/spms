<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('enquiry_number')->unique();
            $table->string('student_name');
            $table->string('phone_number')->unique(); // Unique to prevent duplicates
            $table->string('whatsapp_number')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('place')->nullable();
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('state_id')->nullable()->constrained()->onDelete('set null');
            $table->string('qualification')->nullable();
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('lead_source_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('assigned_employee_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('assigned_team_id')->nullable()->constrained('teams')->onDelete('set null');
            $table->text('remarks')->nullable();
            $table->string('current_status')->default('New'); // New, Walk-in, Registered, Admitted, Full Payment, Follow-up, Lost, Cancelled
            $table->integer('total_score')->default(0); // Cache of the total score computed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
