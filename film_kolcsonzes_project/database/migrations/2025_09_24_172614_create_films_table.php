<?php

use App\Models\Film;
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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->longText('title',150);
            $table->string('director',100);
            $table->year('release_year');
            $table->integer('how_long');
            $table->timestamps();
        });

        Film::create([
            'title' => 'Inception',
            'director' => 'Christopher Nolan',
            'release_year' => 2010,
            'how_long' => 148
        ]);

         Film::create([
            'title' => 'The Matrix',
            'director' => 'The Wachowskis',
            'release_year' => 1999,
            'how_long' => 136
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
