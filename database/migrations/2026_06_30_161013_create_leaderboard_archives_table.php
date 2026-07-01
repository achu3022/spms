<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaderboard_archives', function (Blueprint $table) {
            $table->id();
            $table->integer('month');
            $table->integer('year');
            $table->string('archive_type'); // employee, team
            $table->unsignedBigInteger('entity_id'); // user_id or team_id
            $table->string('name'); // name of the user or team at the time
            $table->integer('score');
            $table->integer('rank');
            $table->timestamps();
            
            $table->unique(['month', 'year', 'archive_type', 'entity_id'], 'unique_archive_entry');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderboard_archives');
    }
};
