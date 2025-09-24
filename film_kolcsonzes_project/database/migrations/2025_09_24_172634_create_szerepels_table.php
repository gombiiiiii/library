<?php

use App\Models\Szerepel;
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
        Schema::create('szerepels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained("films")->onDelete('cascade');
            $table->foreignId('user_id')->constrained("users")->onDelete('cascade');

            $table->timestamps();
        });


    Szerepel::create([
        'film_id' => 1,
        'user_id' => 2
    ]);

    Szerepel::create([
        'film_id' => 2,
        'user_id' => 2
    ]);
    

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('szerepels');
    }
};
