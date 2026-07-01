<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('role')->default('member'); // leader, vice_leader, member
            $table->timestamps();

            // A user can only belong to one team (since every enquiry belongs to one employee and team, it's simpler if they are in one team at a time, but lets allow flexibility. The prompt says: "each team contains leader, vice leader, members. Admin can transfer employees." It's best if user has at most one active team membership)
            $table->unique(['user_id']); // prevents user from being in multiple teams
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
