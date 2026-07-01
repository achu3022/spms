<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enquiry_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('team_id')->nullable()->constrained('teams')->onDelete('set null');
            $table->string('activity_type'); // Walk-in, Registration, Admission, Full Payment, Follow-up, Lost, Cancelled
            $table->text('remarks')->nullable();
            $table->integer('score')->default(0); // Score awarded for this specific activity
            $table->timestamps(); // includes timestamp
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
