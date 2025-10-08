<?php

use App\Models\Copy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    use HasFactory; 
    
    public function up(): void
    {
        Schema::create('copies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained("books")->onDelete('cascade');
            // $table->foreignId('user_id')->constrained("users")->onDelete('cascade');
            $table->boolean('hardcovered')->default(1);
            // hardcovered tábla: 0 - Kemény kötésű , 1 puha kötésű 
            $table->year('publication');
            $table->smallInteger('status')->default(0);
            // Státusz tábla: 0 - könyvtárban , 1 - felh-nál , 2 - selejtes, 3 megsemmisült
            $table->timestamps();
        });

        Copy::create([
            'book_id' => 1,
            // 'user_id' => 2
            'publication' => 2000,
        ]);

         Copy::create([
            'book_id' => 2,
            // 'user_id' => 2
            'publication' => 2020,
            'status' => 2,
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
