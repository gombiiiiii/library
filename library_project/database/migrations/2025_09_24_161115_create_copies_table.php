<?php

use App\Models\Copy;
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
        Schema::create('copies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained("books")->onDelete('cascade');
            $table->foreignId('user_id')->constrained("users")->onDelete('cascade');
            $table->timestamps();
        });

        Copy::create([
            'book_id' => 1,
            'user_id' => 2
        ]);

         Copy::create([
            'book_id' => 2,
            'user_id' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copies');
    }
};
