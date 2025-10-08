<?php

use App\Models\Book;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('author',32);
            $table->longText('title',150);
            // $table->integer('pieces')->default(50);
            $table->timestamps(); // ezzel egyenlőre nem foglalkozunk, de nem töröljük
        });


        Book::create([
            'author' => 'Carl Marx',
            'title' => 'Tőke',
            // 'pieces' => 100
        ]);

         Book::create([
            'author' => 'Stephen King',
            'title' => 'Ragyogás'
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
